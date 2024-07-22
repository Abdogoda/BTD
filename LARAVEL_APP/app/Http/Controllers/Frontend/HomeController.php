<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\Message;
use App\Models\Treatment;
use App\Models\Tumor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller{

    public function index(){
        $doctors = User::where('role', 'doctor')->where('status', 'active')->count();
        $users = User::where('role', 'user')->count();
        $hospitals = Hospital::all()->count();
        $appointments = Appointment::where('status', 'completed')->count();
        return view('frontend.index', compact('doctors', 'hospitals', 'users', 'appointments'));
    }
    
    public function about(){
        $treatments = Treatment::all();
        $tumors = Tumor::all();
        return view('frontend.about', compact('treatments', 'tumors'));
    }
    
    public function contact(){
        return view('frontend.contact');
    }
    
    public function profile(){
        return view('profile.user');
    }

    public function store_message(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ]);
        
        try {
            DB::beginTransaction();
            Message::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ]);
            
            DB::commit();
            toastr()->success('Your message has been sent successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}