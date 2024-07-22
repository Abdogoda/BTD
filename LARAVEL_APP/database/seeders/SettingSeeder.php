<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder{
    public function run(): void{
        $settings = [
            [
                'key' => 'name',
                'value' => 'BTD'
            ],
            [
                'key' => 'email',
                'value' => 'shopplace0@gmail.com'
            ],
            [
                'key' => 'phone',
                'value' => '01019135059'
            ],
            [
                'key' => 'address',
                'value' => 'Abass Elaqad street, Middle Town, Giza, Egypt'
            ],
            [
                'key' => 'location',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d435861.59785673296!2d33.797770141853114!3d31.40947688477306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14fd844104b258a9%3A0xfddcb14b194be8e7!2sGaza%20Strip!5e0!3m2!1sen!2seg!4v1721141017235!5m2!1sen!2seg'
            ],
            [
                'key' => 'about',
                'value' => '"BTD" is an AI-driven platform for brain tumor detection, offering image analysis, medical resources, patient support, specialist directories, and educational content, ensuring privacy and catering to a global audience.'
            ],
            [
                'key' => 'choose',
                'value' => 'Choose "BTD" for precise AI-driven brain tumor detection, comprehensive resources, expert directories, and strong privacy measures. We support a global community with multilingual accessibility and top-notch medical insights.'
            ],
            [
                'key' => 'about_bt',
                'value' => 'A brain tumor is a growth of cells in the brain or near it. Brain tumors can happen in the brain tissue. Brain tumors also can happen near the brain tissue. Nearby locations include nerves, the pituitary gland, the pineal gland, and the membranes that cover the surface of the brain. Brain tumors can begin in the brain. These are called primary brain tumors. Sometimes, cancer spreads to the brain from other parts of the body. These tumors are secondary brain tumors, also called metastatic brain tumors.'
            ],
        ];
        

        DB::table('settings')->insert($settings);
    }
}