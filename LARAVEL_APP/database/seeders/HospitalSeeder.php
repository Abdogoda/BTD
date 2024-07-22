<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder{

    public function run(): void{
        for ($i=0; $i <50 ; $i++) { 
            $phone = '01'.fake()->randomElement([0,1,2,5]).fake()->numberBetween(10000000, 99999999);
            Hospital::create([
                'name' => fake()->company(),
                'address' => fake()->address(),
                'location' => 'https://www.google.com/maps/place/' . urlencode(fake()->address()),
                'email' => fake()->unique()->safeEmail(),
                'phone' => $phone,
                'description' => fake()->paragraph(),
            ]);
        }
    }
}