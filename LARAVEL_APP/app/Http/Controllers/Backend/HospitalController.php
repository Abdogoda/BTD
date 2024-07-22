<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Repositories\HospitalRepositoryInterface;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller{
    protected $hospitalRepository;

    public function __construct(HospitalRepositoryInterface $hospitalRepository){
        $this->hospitalRepository = $hospitalRepository;
    }

    public function index(){
        $hospitals = $this->hospitalRepository->all();
        $all_hospitals_count = Hospital::count();
        return view('backend.hospitals.index', compact('hospitals', 'all_hospitals_count'));
    }

    public function create(){
        return view('backend.hospitals.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:hospitals,email'],
            'phone' => ['required', new ValidPhoneNumber, 'unique:hospitals,phone'],
            'address' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'picture' => ['nullable', 'image'],
        ]);
        
        try {
            DB::beginTransaction();
            $hospital = $this->hospitalRepository->create($request->all());
            
            if($request->hasFile('picture')){
                $hospital->updateFile($request->file('picture'), 'picture', 'hospitals/images');
            }
            
            DB::commit();
            toastr()->success('New Hospital Created Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function show(Hospital $hospital){
        $hospital = $this->hospitalRepository->find($hospital->id);
        if($hospital){
            return view('backend.hospitals.show', compact('hospital'));
        }else{
            toastr()->warning('404 Hospital not found!');
            return redirect()->back();
        }
    }

    public function edit(Hospital $hospital){
        //
    }

    public function update(Request $request, Hospital $hospital){
        if(Hospital::find($hospital->id)){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:hospitals,email,'.$hospital->id ?? 0],
                'phone' => ['required', new ValidPhoneNumber, 'unique:hospitals,phone,'.$hospital->id ?? 0],
                'address' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
                'location' => ['nullable', 'string', 'max:255'],
                'picture' => ['nullable', 'image'],
            ]);
            
            try {
                DB::beginTransaction();
                $this->hospitalRepository->update($hospital->id, $request->all());
                
                if($request->hasFile('picture')){
                    $hospital->updateFile($request->file('picture'), 'picture', 'hospitals/images');
                }
                
                DB::commit();
                toastr()->success('Hospital Updated Successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 Hospital Not Found!');
            return redirect()->back();
        }
    }

    public function destroy(Hospital $hospital){
        if(Hospital::find($hospital->id)){
            try {
                DB::beginTransaction();
                $hospital->deleteFile('picture');
                $this->hospitalRepository->delete($hospital->id);
                DB::commit();
                toastr()->success('Hospital Deleted Successfully');
                return redirect()->to('admin/hospitals');
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 Hospital Not Found!');
            return redirect()->back();
        }
    }
}