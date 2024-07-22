<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\TimeHelper;
use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Repositories\ClinicRepositoryInterface;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller{
    protected $clinicRepository;

    public function __construct(ClinicRepositoryInterface $clinicRepository){
        $this->clinicRepository = $clinicRepository;
    }

    public function index(){
        $doctor = Doctor::where("user_id", auth()->user()->id)->first();
        if($doctor){
            $clinics = $this->clinicRepository->all($doctor->id);
            $all_clinics_count = $clinics->count();
            return view('backend.clinics.index', compact('clinics', 'all_clinics_count'));
        }else{
            toastr()->error('404 Doctor Not Found');
            return redirect()->back();
        }
    }

    public function create(){
        return view('backend.clinics.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', new ValidPhoneNumber, 'unique:clinics,phone'],
            'address' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'visiting_price' => ['required', 'numeric', 'min:10', 'max:10000000'],
            'follow_up_price' => ['nullable', 'numeric', 'min:10', 'max:10000000'],
        ]);
        
        try {
            DB::beginTransaction();

            $doctor = Doctor::where('user_id', auth()->user()->id)->first();
            $attributes = $request->all();
            $attributes['doctor_id'] = $doctor->id;

            $this->clinicRepository->create($attributes);
            
            DB::commit();
            toastr()->success('New clinic has been created successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function show(clinic $clinic){
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        if($clinic->doctor_id != $doctor->id){
            toastr()->error('403 Unauthorized!');
            return redirect()->back();
        }
        $clinic = $this->clinicRepository->find($clinic->id);
        $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $startHoursOfDay = array_merge(TimeHelper::generateHoursList(8, 23), TimeHelper::generateHoursList(0, 2));
        $endHoursOfDay = array_merge(TimeHelper::generateHoursList(9, 23), TimeHelper::generateHoursList(0, 3));
        if($clinic){
            return view('backend.clinics.show', compact('clinic', 'daysOfWeek', 'startHoursOfDay', 'endHoursOfDay'));
        }else{
            toastr()->error('404 Clinic not found!');
            return redirect()->back();
        }
    }

    public function edit(Clinic $clinic){
        //
    }

    public function update(Request $request, Clinic $clinic){
        if(clinic::find($clinic->id)){
            $doctor = Doctor::where('user_id', auth()->user()->id)->first();
            if($clinic->doctor_id != $doctor->id){
                toastr()->error('403 Unauthorized!');
                return redirect()->back();
            }
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', new ValidPhoneNumber, 'unique:clinics,phone,'.$clinic->id ?? 0],
                'address' => ['required', 'string', 'max:255'],
                'location' => ['required', 'string', 'max:255'],
                'visiting_price' => ['required', 'numeric', 'min:10', 'max:10000000'],
                'follow_up_price' => ['nullable', 'numeric', 'min:10', 'max:10000000'],
            ]);
            
            try {
                DB::beginTransaction();
                $this->clinicRepository->update($clinic->id, $request->all());
                
                DB::commit();
                toastr()->success('Clinic has been updated successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 Clinic Not Found!');
            return redirect()->back();
        }
    }

    public function destroy(Clinic $clinic){
        if(clinic::find($clinic->id)){
            $doctor = Doctor::where('user_id', auth()->user()->id)->first();
            if($clinic->doctor_id != $doctor->id){
                toastr()->error('403 Unauthorized!');
                return redirect()->back();
            }
            try {
                DB::beginTransaction();
                $this->clinicRepository->delete($clinic->id);
                DB::commit();
                toastr()->success('Clinic has been deleted successfully');
                return redirect()->to('doctor/clinics');
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 clinic Not Found!');
            return redirect()->back();
        }
    }
}