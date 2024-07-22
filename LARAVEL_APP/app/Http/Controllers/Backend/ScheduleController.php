<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\ClinicSchedule;
use App\Models\Doctor;
use App\Repositories\ScheduleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller{
    
    protected $scheduleRepository;

    public function __construct(ScheduleRepositoryInterface $scheduleRepository){
        $this->scheduleRepository = $scheduleRepository;
    }

    public function store(Request $request){
        if(Clinic::find($request->clinic_id_new)){
            $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            $request->validate([
                'clinic_id_new' => 'required|exists:clinics,id',
                'capacity_new' => ['required', 'numeric', 'min:1', 'max:100'],
                'day_new' => ['required', 'string', 'in:' . implode(',', $daysOfWeek)],
                'start_time_new' => ['required', 'date_format:H:i:s'],
                'end_time_new' => ['required', 'date_format:H:i:s'],
            ]);
            
            try {
                DB::beginTransaction();

                $clinic = Clinic::find($request->clinic_id_new);
                if(!$clinic){
                    toastr()->error('404 Clinic Not Found!');
                    return redirect()->back();
                }
                $attributes = collect($request->all())->mapWithKeys(function ($value, $key) {
                    $newKey = str_replace('_new', '', $key);
                    return [$newKey => $value];
                })->toArray();
                $attributes['doctor_id'] = $clinic->doctor_id;
                
                $this->scheduleRepository->create($attributes);
                
                DB::commit();
                toastr()->success('Clinic schedule has been created successfully');
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

    public function update(Request $request, ClinicSchedule $clinicSchedule){
        if(ClinicSchedule::find($clinicSchedule->id)){
            $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            $request->validate([
                'capacity' => ['required', 'numeric', 'min:1', 'max:100'],
                'day' => ['required', 'string', 'in:' . implode(',', $daysOfWeek)],
                'start_time' => ['required', 'date_format:H:i:s'],
                'end_time' => ['required', 'date_format:H:i:s'],
            ]);
            
            try {
                DB::beginTransaction();
                $this->scheduleRepository->update($clinicSchedule->id, $request->all());
                
                DB::commit();
                toastr()->success('Clinic schedule has been updated successfully');
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
}