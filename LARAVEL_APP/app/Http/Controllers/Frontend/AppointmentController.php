<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller{
    public function index(){
        //
    }

    public function create(){
        $doctors = User::where('role', 'doctor')->where('status', 1)->get();
        return view('frontend.appoinment', compact('doctors'));
    }

    public function store(Request $request){
        //
    }

    public function show(Appointment $appointment){
        //
    }

    public function edit(Appointment $appointment){
        //
    }

    public function update(Request $request, Appointment $appointment){
        //
    }

    public function destroy(Appointment $appointment){
        //
    }
}