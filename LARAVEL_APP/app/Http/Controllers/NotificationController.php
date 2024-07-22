<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Notification;
use App\Repositories\NotificationRepositoryInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller{
    protected $notificationRepository;

    public function __construct(NotificationRepositoryInterface $notificationRepository){
        $this->notificationRepository = $notificationRepository;
    }

    public function admin_notifications(){
        $notifications = $this->notificationRepository->all('admin');
        $unreaded_count = $this->notificationRepository->unreaded_count('admin');
        return view('backend.notifications.index', compact('notifications', 'unreaded_count'));
    }
    
    public function doctor_notifications(){
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        if($doctor){
            $notifications = $this->notificationRepository->all('doctor', $doctor->id);
            $unreaded_count = $this->notificationRepository->unreaded_count('doctor', $doctor->id);
            return view('backend.notifications.index', compact('notifications', 'unreaded_count'));
        }else{
            toastr()->warning('404 Doctor Not Found');
            return redirect()->back();
        }
    }

    public function read(Notification $notification){
        $this->notificationRepository->read($notification->id);
        return redirect()->back();
    }
    
    public function read_all_admin(){
        $this->notificationRepository->read_all('admin');
        return redirect()->back();
    }
    
    public function read_all_doctor(){
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        if($doctor){
            $this->notificationRepository->read_all('doctor', $doctor->id);
            return redirect()->back();
        }else{
            toastr()->warning('404 Doctor Not Found');
            return redirect()->back();
        }
    }
    
    public function delete(Notification $notification){
        $this->notificationRepository->delete($notification->id);
        return redirect()->back();
    }
}