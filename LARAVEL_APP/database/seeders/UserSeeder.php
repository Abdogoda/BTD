<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\ClinicSchedule;
use App\Models\Doctor;
use App\Models\DoctorEducation;
use App\Models\Hospital;
use App\Models\Specialization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        DB::table('users')->insert([
            'first_name' => 'User',
            'last_name' => 'One',
            'email' => 'user1@gmail.com',
            'phone' => '01018135059',
            'gender' => fake()->randomElement(['male', 'female']),
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'One',
            'email' => 'admin1@gmail.com',
            'phone' => '01142766716',
            'role' => 'admin',
            'gender' => fake()->randomElement(['male', 'female']),
            'password' => Hash::make('123456'),
        ]);

        $hospitalIds = Hospital::pluck('id')->toArray();
        $specializationIds = Specialization::pluck('id')->toArray();
        for ($i=0; $i <50 ; $i++) { 
            $phone = '01'.fake()->randomElement([0,1,2,5]).fake()->numberBetween(10000000, 99999999);
            $user = User::create([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => $phone,
                'role' => 'doctor',
                'status' => fake()->randomElement(['active','deactive']),
                'gender' => fake()->randomElement(['male', 'female']),
                'password' => Hash::make('123456'),
            ]);
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'specialization_id' => fake()->randomElement($specializationIds),
                'hospital_id' => fake()->randomElement($hospitalIds),
                'years_of_experience' => fake()->randomDigit(),
                'about' => fake()->paragraph(),
            ]);
            for ($j=0; $j < fake()->numberBetween(0, 8); $j++) { 
                DoctorEducation::create([
                    'doctor_id' => $doctor->id,
                    'name' => fake()->company(),
                    'description' => fake()->paragraph(),
                    'start' => fake()->year(),
                    'end' => fake()->year(),
                    'type' => fake()->randomElement(['education', 'experience'])
                ]);
            }
            for ($k=0; $k < fake()->numberBetween(1, 3); $k++) { 
                $price = fake()->randomFloat(2, 100, 1000);
                $phone = '01'.fake()->randomElement([0,1,2,5]).fake()->numberBetween(10000000, 99999999);
                $clinic = Clinic::create([
                    'doctor_id' => $doctor->id,
                    'name' => fake()->company(),
                    'phone' => $phone,
                    'address' => fake()->address(),
                    'location' => 'https://www.google.com/maps/place/' . urlencode(fake()->address()),
                    'visiting_price' => $price,
                    'follow_up_price' => $price/2
                ]);
                $daysOfWeek = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                $days = fake()->randomElements($daysOfWeek, fake()->numberBetween(1, 3));
                foreach ($days as $day) {
                    $startHour = fake()->numberBetween(16, 20);
                    $startTime = Carbon::createFromTime($startHour, 0, 0);
                    $endTime = $startTime->copy()->addHours(4);
                    if(!ClinicSchedule::where('doctor_id', $doctor->id)->where('day', $day)->first() && ClinicSchedule::where('doctor_id', $doctor->id)->count() < 5) {
                        ClinicSchedule::create([
                            'clinic_id' => $clinic->id,
                            'doctor_id' => $doctor->id,
                            'capacity' => fake()->numberBetween(2, 8),
                            'day' => $day,
                            'start_time' => $startTime->format('H:i'),
                            'end_time' => $endTime->format('H:i'),
                        ]);
                    }
                }
            } 
        }   
    }
}