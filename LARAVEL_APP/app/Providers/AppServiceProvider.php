<?php

namespace App\Providers;

use App\Models\Setting;
use App\Repositories\AdminRepository;
use App\Repositories\AdminRepositoryInterface;
use App\Repositories\AppointmentRepository;
use App\Repositories\AppointmentRepositoryInterface;
use App\Repositories\ClinicRepository;
use App\Repositories\ClinicRepositoryInterface;
use App\Repositories\DoctorRepository;
use App\Repositories\DoctorRepositoryInterface;
use App\Repositories\HospitalRepository;
use App\Repositories\HospitalRepositoryInterface;
use App\Repositories\MessageRepository;
use App\Repositories\MessageRepositoryInterface;
use App\Repositories\NotificationRepository;
use App\Repositories\NotificationRepositoryInterface;
use App\Repositories\ScheduleRepository;
use App\Repositories\ScheduleRepositoryInterface;
use App\Repositories\SettingRepository;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\TreatmentRepository;
use App\Repositories\TreatmentRepositoryInterface;
use App\Repositories\TumorRepository;
use App\Repositories\TumorRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider{
    /**
     * Register any application services.
     */
    public function register(): void{
        
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);
        $this->app->bind(HospitalRepositoryInterface::class, HospitalRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(TreatmentRepositoryInterface::class, TreatmentRepository::class);
        $this->app->bind(TumorRepositoryInterface::class, TumorRepository::class);
        $this->app->bind(ClinicRepositoryInterface::class, ClinicRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void{
        Paginator::useBootstrap();

        $siteSettings = cache()->remember(
            'siteSettings',
            3600,
            fn() => Setting::all()->keyBy('key')
        );
        view()->share('siteSettings', $siteSettings);
    }
}