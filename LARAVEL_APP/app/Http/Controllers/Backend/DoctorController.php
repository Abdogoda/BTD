<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Detection;
use App\Models\Doctor;
use App\Models\DoctorDocuments;
use App\Models\Hospital;
use App\Models\Specialization;
use App\Models\User;
use App\Notifications\DoctorActivation;
use App\Repositories\DoctorRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller{
    protected $doctorRepository;

    public function __construct(DoctorRepositoryInterface $doctorRepository){
        $this->doctorRepository = $doctorRepository;
    }

    public function index(){
        $doctors = $this->doctorRepository->all(12);
        $all_doctors_count = Doctor::count();
        return view('backend.doctors.index', compact('doctors', 'all_doctors_count'));
    }

    public function show(Doctor $doctor){
        $doctor = $this->doctorRepository->find($doctor->id);
        if($doctor){
            return view('backend.doctors.show', compact('doctor'));
        }else{
            toastr()->warning('404 doctor not found!');
            return redirect()->back();
        }
    }
    public function change_status(Doctor $doctor){
        if($doctor){
            $doctor->user->update([
                'status' => $doctor->user->status == 'active' ? "deactive" : "active"
            ]);
            if($doctor->user->status == 'active'){
                $user = User::find($doctor->user_id);
                $user->notify(new DoctorActivation());
            }
            toastr()->success('Doctor status changed successfully');
            return redirect()->back();
        }else{
            toastr()->warning('404 doctor not found!');
            return redirect()->back();
        }
    }
    

    // DASHBORAD ============================
    public function dashboard(){
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $previousMonth = Carbon::now()->subMonth()->month;

        $doctor = Doctor::where('user_id', auth()->user()->id)->first();

        $all_appointments = Appointment::where('doctor_id', $doctor->id)->count();
        $this_month_appointments = Appointment::where('doctor_id', $doctor->id)->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->count();
        $completed_appointments = Appointment::where('doctor_id', $doctor->id)->where('status', 'completed')->count();
        $pending_appointments = Appointment::where('doctor_id', $doctor->id)->where('status', 'pending')->count();
        $cancelled_appointments = Appointment::where('doctor_id', $doctor->id)->where('status', 'cancelled')->count();
        $monthly_sums = Appointment::selectRaw('MONTH(created_at) as month, SUM(appointment_price) as total')
            ->where('doctor_id', $doctor->id)
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        
        $currentMonthEarnings = Appointment::where('doctor_id', $doctor->id)->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('appointment_price');
        
        $previousMonthEarnings = Appointment::where('doctor_id', $doctor->id)->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $previousMonth)
            ->sum('appointment_price');
        
        $recent_appointments = Appointment::where('doctor_id', $doctor->id)->latest()->take(5)->get();
        $recent_detections = Detection::where('doctor_id', $doctor->id)->latest()->take(5)->get();
        
        return view('backend.dashboard.doctor', compact(
            'doctor', 
            'all_appointments', 
            'this_month_appointments', 
            'completed_appointments', 
            'cancelled_appointments', 
            'pending_appointments',
            'monthly_sums',
            'currentMonthEarnings',
            'previousMonthEarnings',
            'recent_appointments',
            'recent_detections'
        ));
    }
    
    public function profile(){
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        if($doctor){
            $specializations = Specialization::all();
            $hospitals = Hospital::all();
            return view('profile.doctor', compact('doctor', 'specializations', 'hospitals'));
        }else{
            toastr()->warning('403 Unauthorized!');
            return redirect()->back();
        }
    }

    
    public function update_profile(Request $request){
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        if($doctor){
            $request->validate([
                'specialization_id' => ['required', 'string', 'exists:specializations,id'],
                'hospital_id' => ['nullable', 'string', 'exists:hospitals,id'],
                'years_of_experience' => ['nullable', 'numeric', 'between:0,50'],
                'about' => ['nullable', 'string'],
                'documents' => 'nullable|array|min:1',
                'documents.*' => ['required','mimes:jpg,jpeg,png,pdf,doc,docx','max:3000'],
            ]);
            $attributes = $request->except('documents');
            try {
                $this->doctorRepository->update($doctor->id, $attributes);
                if($request->hasFile('documents')){
                    foreach ($request->file('documents') as $file) {
                        $dateTimeNow = now()->format('Y-m-d_H-i-s');
                        $filename = $doctor->id . "." . $dateTimeNow . '.' . $file->getClientOriginalName();
                        $path = $file->storeAs('uploads/users/documents', $filename, 'public');
                        DoctorDocuments::create([
                            'doctor_id' => $doctor->id,
                            'path' => $path,
                            'type' => $file->getClientOriginalExtension(),
                        ]);
                    }
                }
                
                toastr()->success('Doctor information has been changed successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->warning('404 doctor not found!');
            return redirect()->back();
        }
    }
    
    public function document_store(Request $request){
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        if($doctor){
            $request->validate([
                'documents' => 'required|array|min:1',
                'documents.*' => ['required','mimes:jpg,jpeg,png,pdf,doc,docx','max:5120'],
            ]);
            try {
                if($request->hasFile('documents')){
                    foreach ($request->file('documents') as $file) {
                        $dateTimeNow = now()->format('Y-m-d_H-i-s');
                        $filename = $doctor->id . "." . $dateTimeNow . '.' . $file->getClientOriginalName();
                        $path = $file->storeAs('uploads/users/documents', $filename, 'public');
                        DoctorDocuments::create([
                            'doctor_id' => $doctor->id,
                            'path' => $path,
                            'type' => $file->getClientOriginalExtension(),
                        ]);
                    }
                }
                
                toastr()->success('Doctor document has been added successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->warning('404 doctor not found!');
            return redirect()->back();
        }
    }

    public function document_delete($id){
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        $doctor_document = DoctorDocuments::where('doctor_id', $doctor->id)->first();
        if($doctor && $doctor_document){
            try {
                if (Storage::disk('public')->exists($doctor_document->path)) {
                    Storage::disk('public')->delete($doctor_document->path);
                }
                $doctor_document->delete();
                
                toastr()->success('Doctor document has been deleted successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->warning('404 doctor not found!');
            return redirect()->back();
        }
    }
    
    
}