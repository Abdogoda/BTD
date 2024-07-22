<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use App\Repositories\TreatmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentController extends Controller{
    protected $treatmentRepository;

    public function __construct(TreatmentRepositoryInterface $treatmentRepository){
        $this->treatmentRepository = $treatmentRepository;
    }

    public function index(){
        $treatments = $this->treatmentRepository->all();
        $all_treatments_count = Treatment::count();
        return view('backend.treatments.index', compact('treatments', 'all_treatments_count'));
    }

    public function create(){
        return view('backend.treatments.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:treatments,title'],
            'description' => ['required', 'string', 'max:1500'],
        ]);
        
        try {
            DB::beginTransaction();
            $this->treatmentRepository->create($request->all());
            
            DB::commit();
            toastr()->success('New Treatment Has Been Created Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function show(treatment $treatment){
        $treatment = $this->treatmentRepository->find($treatment->id);
        if($treatment){
            return view('backend.treatments.show', compact('treatment'));
        }else{
            toastr()->warning('404 treatment not found!');
            return redirect()->back();
        }
    }

    public function edit(treatment $treatment){
        //
    }

    public function update(Request $request, treatment $treatment){
        if(treatment::find($treatment->id)){
            $request->validate([
                'title' => ['required', 'string', 'max:255', 'unique:treatments,title,'.$treatment->id ?? 0],
                'description' => ['required', 'string', 'max:1500'],
            ]);
            
            try {
                DB::beginTransaction();
                $this->treatmentRepository->update($treatment->id, $request->all());
                
                DB::commit();
                toastr()->success('Treatment Has Been Updated Successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 treatment Not Found!');
            return redirect()->back();
        }
    }

    public function destroy(treatment $treatment){
        if(treatment::find($treatment->id)){
            try {
                DB::beginTransaction();
                $this->treatmentRepository->delete($treatment->id);
                DB::commit();
                toastr()->success('treatment Has Been Deleted Successfully');
                return redirect()->to('admin/treatments');
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 treatment Not Found!');
            return redirect()->back();
        }
    }
}