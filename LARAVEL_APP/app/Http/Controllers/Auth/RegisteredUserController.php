<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorDocuments;
use App\Models\Hospital;
use App\Models\Notification;
use App\Models\Specialization;
use App\Models\User;
use App\Notifications\UserRegistered;
use App\Providers\RouteServiceProvider;
use App\Rules\ValidPhoneNumber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller{

    public function create(): View{
        return view('auth.register');
    }

    public function doctor_create(): View{
        $specializations = Specialization::all();
        $hospitals = Hospital::all();
        return view('auth.doctor_register', compact('specializations', 'hospitals'));
    }

    public function store(Request $request): RedirectResponse{
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', new ValidPhoneNumber, 'unique:users,phone'],
            'address' => ['nullable', 'string', 'max:255'],
            'year_of_birth' => ['nullable', 'numeric', 'digits:4', 'between:1920,'.date('Y')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'picture' => ['nullable', 'image'],
        ]);
        
        try {
            DB::beginTransaction();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'year_of_birth' => $request->year_of_birth,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);
            
            if($request->hasFile('picture')){
                $user->updateFile($request->file('picture'), 'picture', 'users/images');
            }
            
            event(new Registered($user));
            
            $user->notify(new UserRegistered());
            
            Auth::login($user);
            
            DB::commit();
            toastr()->success('Welcome Back, You have created your account successfully');
            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function store_doctor(Request $request): RedirectResponse{
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', new ValidPhoneNumber, 'unique:users,phone'],
            'specialization_id' => ['required', 'string', 'exists:specializations,id'],
            'hospital_id' => ['nullable', 'string', 'exists:hospitals,id'],
            'address' => ['nullable', 'string', 'max:255'],
            'year_of_birth' => ['nullable', 'numeric', 'between:1920,2024'],
            'years_of_experience' => ['nullable', 'numeric', 'between:0,50'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'about' => ['nullable', 'string'],
            'picture' => ['nullable', 'image'],
            'documents' => 'required|array|min:1',
            'documents.*' => ['required','mimes:jpg,jpeg,png,pdf,doc,docx','max:3000'],
        ]);

        try {
            DB::beginTransaction();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => 'doctor',
                'gender' => $request->gender,
                'year_of_birth' => $request->year_of_birth,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);
            
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'specialization_id' => $request->specialization_id,
                'hospital_id' => $request->hospital_id,
                'years_of_experience' => $request->years_of_experience,
                'about' => $request->about,
            ]);
            
            if($request->hasFile('picture')){
                $user->updateFile($request->file('picture'), 'picture', 'users/images');
            }
            
            if($request->hasFile('documents')){
                foreach ($request->file('documents') as $file) {
                    $dateTimeNow = now()->format('Y-m-d_H-i-s');
                    $filename = $doctor->id . "." . $dateTimeNow . '.' . $file->getClientOriginalName();
                    $path = $file->storeAs('uploads/users/documents', $filename, 'public');
                    DoctorDocuments::create([
                        'doctor_id' => $doctor->id,
                        'path' => $path,
                        'type' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
            
            event(new Registered($user));
            
            $user->notify(new UserRegistered());


            $profileUrl = route('admin.doctor', $doctor);
            $htmlMessage = '<strong>Hello Admin!</strong> <br> A new doctor has been registered. <br> Review his application to activate his account. <a href="' . $profileUrl . '">View doctor profile</a>.';

            $notification = Notification::create([
                'notification_for' => 'admin',
                'message' => $htmlMessage
            ]);
            
            DB::commit();
            toastr()->success('Welcome Back, You have created your account successfully, Check your email for further instructions');
            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}