<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Report;
use App\Models\User;
use App\Notifications\AppointmentCompleted;
use App\Repositories\AppointmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller{
    protected $appointmentRepository;

    public function __construct(AppointmentRepositoryInterface $appointmentRepository){
        $this->appointmentRepository = $appointmentRepository;
    }

    public function index(Request $request){
        $doctor = Doctor::where("user_id", auth()->user()->id)->first();
        if($doctor){
            $status = $request->input('status');
            if($status && $status != ''){
                $appointments = $this->appointmentRepository->all($doctor->id, $status);
            }else{
                $appointments = $this->appointmentRepository->all($doctor->id);
            }
            $all_appointments_count = $appointments->count();
            return view('backend.appointments.index', compact('appointments', 'all_appointments_count'));
        }else{
            toastr()->warning('404 Doctor Not Found');
            return redirect()->back();
        }
    }

    public function show(Appointment $appointment){
        $doctor = Doctor::where("user_id", auth()->user()->id)->first();
        $appointment = $this->appointmentRepository->find($appointment->id);
        if($appointment && $appointment->doctor_id == $doctor->id){
            return view('backend.appointments.show', compact('appointment'));
        }else{
            toastr()->warning('404 Appointment not found!');
            return redirect()->back();
        }
    }

    public function update_status(Request $request, Appointment $appointment){
        $doctor = Doctor::where("user_id", auth()->user()->id)->first();
        $user = User::find($appointment->user_id);
        if(Appointment::find($appointment->id) && $appointment->doctor_id == $doctor->id){
            $request->validate([
                'status' => ['required', 'string', 'max:255', 'in:completed,cancelled'],
            ]);
            try {
                DB::beginTransaction();
                $this->appointmentRepository->update_status($appointment->id, $request->status);
                if($request->status == 'completed'){
                    $user->notify(new AppointmentCompleted([
                        "doctor" => $doctor->user->first_name . " " . $doctor->user->last_name,
                        'date' => $appointment->appointment_date,
                    ]));
                }
                DB::commit();
                toastr()->success('Appointment status has been changed from Pending to '.$appointment->status.' successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 Appointment Not Found!');
            return redirect()->back();
        }
    }

    public function add_report(Request $request, Appointment $appointment){
        $doctor = Doctor::where("user_id", auth()->user()->id)->first();
        $user = User::find($appointment->user_id);
        if(Appointment::find($appointment->id) && $appointment->doctor_id == $doctor->id){
            $request->validate([
                'diagnosis' => ['required', 'string', 'max:255'],
                'report' => ['required', 'string', 'max:2000'],
            ]);
            $attributes = $request->all();
            $attributes['appointment_id'] = $appointment->id;
            try {
                DB::beginTransaction();
                $appointment_report = Report::create($attributes);
                $this->appointmentRepository->update_status($appointment->id, 'completed');
                $user->notify(new AppointmentCompleted([
                    "doctor" => $doctor->user->first_name . " " . $doctor->user->last_name,
                    'date' => $appointment->appointment_date,
                    'diagnosis' => $appointment_report->diagnosis,
                    'report' => $appointment_report->report,
                ]));
                DB::commit();
                toastr()->success('Appointment status has been changed from Pending to '.$appointment->status.' successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 Appointment Not Found!');
            return redirect()->back();
        }
    }

    public function destroy(Appointment $appointment){
        if(Appointment::find($appointment->id)){
            try {
                DB::beginTransaction();
                $this->appointmentRepository->delete($appointment->id);
                DB::commit();
                toastr()->success('Appointment has been deleted successfully');
                return redirect()->to('doctor/appointments');
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 Appointment Not Found!');
            return redirect()->back();
        }
    }
}