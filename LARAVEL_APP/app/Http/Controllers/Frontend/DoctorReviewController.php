<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorReview;
use App\Repositories\DoctorReviewRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorReviewController extends Controller{

    public function store(Request $request){
        $user_appointments = auth()->user()->appointments;
        if($user_appointments->count() > 0){
            $request->validate([
                'stars' => ['required', 'numeric', 'between:0,5'],
                'comment' => ['nullable', 'string', 'max:500'],
                'doctor_id' => ['required', 'exists:doctors,id'],
            ]);
            $attributes = $request->all();
            $attributes['user_id'] = auth()->user()->id;

            try {
                DB::beginTransaction();
                
                DoctorReview::create($attributes);
                
                DB::commit();
                toastr()->success('Your review has been sent successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->warning('You should book an appointment at this doctor first to be reviewed!');
            return redirect()->back();
        }
    }

    
    public function destroy(DoctorReview $doctor){
        //
    }
}