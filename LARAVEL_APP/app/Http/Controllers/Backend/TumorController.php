<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tumor;
use App\Repositories\TumorRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TumorController extends Controller{
    protected $tumorRepository;

    public function __construct(TumorRepositoryInterface $tumorRepository){
        $this->tumorRepository = $tumorRepository;
    }

    public function index(){
        $tumors = $this->tumorRepository->all();
        $all_tumors_count = Tumor::count();
        return view('backend.tumors.index', compact('tumors', 'all_tumors_count'));
    }

    public function create(){
        return view('backend.tumors.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required', 'unique:tumors,title', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'picture' => ['required', 'image'],
        ]);
        
        try {
            DB::beginTransaction();
            $tumor = $this->tumorRepository->create($request->all());
            
            if($request->hasFile('picture')){
                $tumor->updateFile($request->file('picture'), 'picture', 'tumors/images');
            }
            
            DB::commit();
            toastr()->success('New Tumor Created Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function show(Tumor $tumor){
        $tumor = $this->tumorRepository->find($tumor->id);
        if($tumor){
            return view('backend.tumors.show', compact('tumor'));
        }else{
            toastr()->warning('404 Tumor not found!');
            return redirect()->back();
        }
    }

    public function edit(Tumor $tumor){
        //
    }

    public function update(Request $request, Tumor $tumor){
        if(Tumor::find($tumor->id)){
            $request->validate([
                'title' => ['required', 'string', 'max:255', 'unique:tumors,title,'.$tumor->id ?? 0],
                'description' => ['required', 'string', 'max:2000'],
                'picture' => ['nullable', 'image'],
            ]);
            
            try {
                DB::beginTransaction();
                $this->tumorRepository->update($tumor->id, $request->all());
                
                if($request->hasFile('picture')){
                    $tumor->updateFile($request->file('picture'), 'picture', 'tumors/images');
                }
                
                DB::commit();
                toastr()->success('Tumor Updated Successfully');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 Tumor Not Found!');
            return redirect()->back();
        }
    }

    public function destroy(Tumor $tumor){
        if(Tumor::find($tumor->id)){
            try {
                DB::beginTransaction();
                $tumor->deleteFile('picture');
                $this->tumorRepository->delete($tumor->id);
                DB::commit();
                toastr()->success('Tumor Deleted Successfully');
                return redirect()->to('admin/tumors');
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error($e->getMessage());
                return redirect()->back();
            }
        }else{
            toastr()->error('404 Tumor Not Found!');
            return redirect()->back();
        }
    }
}