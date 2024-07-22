<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\Hospital;
use App\Repositories\HospitalRepositoryInterface;
use Illuminate\Http\Request;

class HospitalController extends Controller{
    protected $hospitalRepository;

    public function __construct(HospitalRepositoryInterface $hospitalRepository){
        $this->hospitalRepository = $hospitalRepository;
    }

    public function index(){
        $hospitals = $this->hospitalRepository->all();
        return view('frontend.hospitals.index', compact('hospitals'));
    }

    public function show(Hospital $hospital){
        $hospital = $this->hospitalRepository->find($hospital->id);
        if($hospital){
            return view('frontend.hospitals.show', compact('hospital'));
        }else{
            toastr()->warning('404 Hospital not found!');
            return redirect()->back();
        }
    }
}