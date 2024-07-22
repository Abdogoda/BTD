<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder{
    
    public function run(): void{
        $specializations = [
            "Neurosurgeons",
            "Neuro-oncologists",
            "Radiation Oncologists",
            "Neurologists",
            "Pathologists",
            "Radiologists",
            "Pediatric Neuro-oncologists",
            "Medical Oncologists",
            "Endocrinologists",
            "Neuropsychologists",
            "Palliative Care Specialists",
            "Rehabilitation Specialists"
        ];

        foreach ($specializations as $specialization) {
            Specialization::create([
                'name' => $specialization
            ]);
        }
    }
}