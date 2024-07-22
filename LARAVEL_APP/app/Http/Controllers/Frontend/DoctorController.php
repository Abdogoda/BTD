<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\Doctor;
use App\Models\Specialization;
use App\Repositories\DoctorRepositoryInterface;
use Illuminate\Http\Request;

class DoctorController extends Controller{
    protected $doctorRepository;

    public function __construct(DoctorRepositoryInterface $doctorRepository){
        $this->doctorRepository = $doctorRepository;
    }

    public function index(){
        $doctors =  Doctor::whereHas('user', function ($query) {
            $query->where('status', 'active');
        })->paginate(12);
        $specializations = Specialization::all();
        return view('frontend.doctors.index', compact('doctors', 'specializations'));
    }

    public function show(Doctor $doctor){
        $doctor = $this->doctorRepository->find($doctor->id);
        if($doctor){
            return view('frontend.doctors.show', compact('doctor'));
        }else{
            toastr()->warning('404 doctor not found!');
            return redirect()->back();
        }
    }

    public function edit(Doctor $doctor){
        //
    }

    
    public function update(Request $request, Doctor $doctor){
        //
    }
}