<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Detection;
use App\Models\Doctor;
use App\Models\Tumor;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DetectionController extends Controller{

    public function index(){
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        $detections = Detection::where('doctor_id', $doctor->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('backend.detections.index', compact('detections'));
    }
    
    public function create(){
        return view('backend.detections.create');
    }
    
    public function store(Request $request){
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        $request->validate([
            'picture' => ['required', 'image', 'max:10000'],
        ]);
        
        try {
            DB::beginTransaction();
            
            $input_image = $request->file('picture');

            $client = new Client();

            $response = $client->post(env('FLASK_APP_URL').'/detect', [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => file_get_contents($input_image),
                        'filename' => $input_image->getClientOriginalName()
                    ]
                ]
            ]);
            
            if ($response){
                $detection_result = $response->getHeader('detection_result')[0];
                $classification_result = $response->getHeader('classification_result')[0];
                $output_image = $response->getBody();

                // Save the input and output image from the response
                $dateTimeNow = now()->format('Y-m-d_H-i-s');
                $dateTimeNow = $dateTimeNow.'.'.$doctor->id;
                $input_file_name = $dateTimeNow . '.input_image.' . $input_image->getClientOriginalExtension();
                $output_file_name = $dateTimeNow . '.output_image.' . $input_image->getClientOriginalExtension();
                $input_image_path = $input_image->storeAs('uploads/detections/inputs', $input_file_name, 'public');
                $output_image_path = 'uploads/detections/outputs/' . $output_file_name;
                Storage::disk('public')->put($output_image_path, $output_image);

                // insert in detection table
                $detection = Detection::create([
                    'doctor_id' => $doctor->id,
                    'detection_result' => $detection_result,
                    'classification_result' => $classification_result,
                    'input_image' => $input_image_path,
                    'output_image' => $output_image_path
                ]);
                

            }else{
                return redirect()->back()->with('error', 'Something went wrong with the server!');
            }

            DB::commit();
            toastr()->success('Detection has been done successfully');
            $tumor = Tumor::where('title', ucwords(str_replace('_', ' ', $classification_result)))->first();
            if($tumor){
                return redirect()->back()->with([
                    'detection_result' => $detection_result,
                    'classification_result' => $classification_result,
                    'input_image' => $input_image_path,
                    'output_image' => $output_image_path,
                    'time' => Carbon::parse($detection->created_at)->format('Y-m-d l h:i A'),
                    'tumor_title' => $tumor->title,
                    'tumor_description' => $tumor->description,
                ]);
            }else{
                return redirect()->back()->with([
                    'detection_result' => $detection_result,
                    'classification_result' => $classification_result,
                    'input_image' => $input_image_path,
                    'output_image' => $output_image_path,
                    'time' => Carbon::parse($detection->created_at)->format('Y-m-d l h:i A')
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    

}