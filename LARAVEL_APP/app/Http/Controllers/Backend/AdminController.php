<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Detection;
use App\Models\User;
use App\Notifications\UserRegistered;
use App\Repositories\AdminRepositoryInterface;
use App\Rules\ValidPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller{
    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository){
        $this->adminRepository = $adminRepository;
    }

    public function index(){
        $admins = $this->adminRepository->all();
        return view('backend.admins.index', compact('admins'));
    }
    
    public function find(User $user){
        return view('backend.admins.show');
    }

    public function create(){
        return view('backend.admins.create');
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', new ValidPhoneNumber, 'unique:users,phone'],
            'address' => ['nullable', 'string', 'max:255'],
            'year_of_birth' => ['nullable', 'numeric', 'digits:4', 'between:1920,'.date('Y')],
            'password' => ['required', 'confirmed', 'min:6'],
            'picture' => ['nullable', 'image'],
        ]);
        
        try {
            DB::beginTransaction();
            $user = $this->adminRepository->create($request->all());
            
            if($request->hasFile('picture')){
                $file = $request->file('picture');
                $dateTimeNow = now()->format('Y-m-d_H-i-s');
                $filename = $dateTimeNow . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/users/images', $filename, 'public');
                $user->picture = $path;
                $user->save();
            }
            
            $user->notify(new UserRegistered());
            
            DB::commit();
            toastr()->success('You have created a new admin account successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    
    public function dashboard(){
        $admins = User::where('role', 'admin')->count();
        $users = User::where('role', 'user')->count();
        $doctors = User::where('role', 'doctor')->count();
        $appointments = Appointment::count();
        $recent_appointments = Appointment::latest()->take(5)->get();
        $recent_detections = Detection::latest()->take(5)->get();
        return view('backend.dashboard.admin', compact(
            'users',
            'admins',
            'doctors',
            'appointments',
            'recent_appointments',
            'recent_detections'
        ));
    }
    
    public function profile(){
        return view('profile.admin');
    }
    
}