<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    
    public function run(): void{

        $this->call([
            HospitalSeeder::class,
            SettingSeeder::class,
            SpecializationSeeder::class,
            UserSeeder::class,
            TreatmentSeeder::class,
            TumorSeeder::class,
        ]);
    }
}