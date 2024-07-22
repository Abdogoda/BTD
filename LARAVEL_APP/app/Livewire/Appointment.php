<?php

namespace App\Livewire;

use App\Models\Appointment as ModelsAppointment;
use App\Models\Clinic;
use App\Models\ClinicSchedule;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\BookAppointment;
use App\Rules\ValidPhoneNumber;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Appointment extends Component{
    public $name, $phone, $age, $gender=null, $message='';
    public $doctor_id="Select Doctor", $clinic_id="Select Clinic", $day='Select Day', $address, $price, $time="Select Time", $number=null, $date=null;
    public $doctors = [];
    public $clinics = [];
    public $clinic_days = [];
    public $clinic_day_times = [];
    public $times = [];

    
    public $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'gender' => ['nullable', 'string', 'in:male,female'],
        'age' => ['nullable', 'numeric', 'between:1,130'],
        'phone' => ['nullable'],
        'doctor_id' => ['required', 'numeric', 'exists:doctors,id'],
        'clinic_id' => ['required', 'numeric', 'exists:clinics,id'],
        'day' => ['required', 'string', 'in:sunday,monday,tuesday,wednesday,thursday,friday,saturday'],
        'time' => ['required'],
        'message' => ['nullable', 'string', 'max:255'],
    ];

    public function mount(){
        $this->doctors = Doctor::whereHas('user', function ($query) {
            $query->where('status', 'active');
        })->get();
    }

    

    public function updatedDoctorId($doctor_id){
        $this->clinics = Clinic::where('doctor_id', $doctor_id)->get();
        $this->clinic_id = 'Select Clinic';
        $this->day = 'Select Day';
        $this->time = 'Select Time';
        $this->number = null;
        $this->date = null;
        $this->price = 0;
        $this->clinic_days = [];
        $this->clinic_day_times = [];
        if($this->clinics->count() > 0){
            $this->clinic_id = $this->clinics[0]->id;
            $this->address = $this->clinics[0]->address;
            $this->price = $this->clinics[0]->visiting_price;
            $this->clinic_days = $this->clinics[0]->clinic_schedule;
        }
    }

    public function updatedClinicId($clinic_id){
        $clinic = Clinic::find($clinic_id);
        $this->day = 'Select Day';
        $this->time = 'Select Time';
        $this->price = $clinic->visiting_price;
        $this->number = null;
        $this->date = null;
        $this->clinic_day_times = [];
        $this->clinic_days = $clinic->clinic_schedule;
        $this->address = $clinic->address;
    }

    public function updatedDay($day){
        $this->time = 'Select Time';
        $this->number = null;
        $currentDate = Carbon::now();
        $this->date = $currentDate->copy()->next($day)->format('Y-m-d');
        $schedule = ClinicSchedule::where('doctor_id', $this->doctor_id)->where('clinic_id', $this->clinic_id)->where('day', $day)->first();
        $appointment_times = ModelsAppointment::where('doctor_id', $this->doctor_id)->where('clinic_id', $this->clinic_id)->where('appointment_day', $day)->where('appointment_date', $this->date)->pluck('appointment_time');
        $this->clinic_day_times = $this->generateAvailableTimes($schedule->start_time, $schedule->end_time, $schedule->capacity, $appointment_times->toArray());
    }

    public function updatedTime($time){
        $this->number = array_search($time, $this->times)+1;
    }

    public function generateAvailableTimes($start_time, $end_time, $capacity, $appointment_times=null){
        $start = $start_time->copy();
        $end = $end_time->copy();
        $times = [];
        $available_times = [];
        
        $totalMinutes = $end->diffInMinutes($start);
        $interval = $totalMinutes / $capacity;

        for ($i = 0; $i < $capacity; $i++) {
            $time = $start->copy()->addMinutes($i * $interval)->format('H:i:s');
            $times[] = $time;
            if(!in_array($time, $appointment_times)){
                $available_times[] = $time;
            }
        }

        $this->times = $times;

        return $available_times;
    }

    public function submit(){
        $this->validate();
        try {
            DB::beginTransaction();
            $appoitnment = ModelsAppointment::create([
                "user_id" => auth()->user()->id,
                "doctor_id" => $this->doctor_id,
                "clinic_id" => $this->clinic_id,
                "patient_name" => $this->name,
                "patient_age" => $this->age,
                "patient_gender" => $this->gender ?? auth()->user()->gender,
                "patient_phone" => $this->phone ?? auth()->user()->phone,
                "appointment_price" => $this->price,
                "appointment_day" => $this->day,
                "appointment_type" => 'visit',
                "appointment_date" => $this->date,
                "appointment_time" => $this->time,
                "appointment_number" => $this->number,
                "message" => $this->message,
            ]);
            
            // Send notification email
            $doctor = Doctor::find($this->doctor_id);
            $clinic = Clinic::find($this->clinic_id);
            $user = User::find(auth()->user()->id);
            $user->notify(new BookAppointment([
                'name' => $this->name,
                'age' => $this->age,
                'gender' => $this->gender,
                'phone' => $this->phone,
                "doctor" => $doctor->user->first_name . " " . $doctor->user->last_name,
                'clinic' => $clinic->name,
                'clinic_address' => $clinic->address,
                'clinic_phone' => $clinic->phone,
                'price' => $this->price,
                'day' => $this->day,
                'date' => $this->date,
                'time' => $this->time,
                'number' => $this->number,
                'type' => 'Visit',
            ]));

            // send notification to doctor
            $appointment_url = route('doctor.appointment', $appoitnment);
            $htmlMessage = '<strong>Hello Dr/ '.$doctor->user->first_name . ' ' . $doctor->user->last_name.'</strong> <br> A new appointment has been booked in '. $this->date .' at '. $this->time .' <br> Review this application now. <a href="' . $appointment_url . '">View Appointment</a>.';

            $notification = Notification::create([
                'notification_for' => 'doctor',
                'doctor_id' => $doctor->id,
                'message' => $htmlMessage
            ]);

            DB::commit();
            
            $this->reset([
                'name', 'phone', 'age', 'gender',
                'doctor_id', 'clinic_id', 'day', 'time', 'address',
                'number', 'price', 'clinics', 'date'
            ]);

            toastr()->info('Check your email for more instructions');
            toastr()->success('Your appointment has been created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
        }
    }


    public function render(){
        return view('livewire.appointment');
    }
}