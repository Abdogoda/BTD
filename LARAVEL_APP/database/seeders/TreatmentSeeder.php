<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreatmentSeeder extends Seeder{

    public function run(): void{
        $treatments = [
            [
                'title' => 'Surgery',
                'description' => '<p><strong>Objective:</strong> Surgery aims to remove as much of the tumor as possible while preserving brain function.</p>
                                  <p><strong>Indications:</strong> Feasible for tumors that are accessible and can be safely removed without causing significant neurological damage.</p>
                                  <p><strong>Types:</strong> Different surgical approaches may be used, including craniotomy (opening the skull) and minimally invasive techniques.</p>'
            ],
            [
                'title' => 'Radiation Therapy',
                'description' => '<p><strong>Objective:</strong> Uses high-energy rays to destroy cancer cells or shrink tumors.</p>
                                  <p><strong>Indications:</strong> Used after surgery to kill remaining cancer cells or as a primary treatment when surgery is not possible.</p>
                                  <p><strong>Types:</strong> External beam radiation (from outside the body) or internal radiation (implanted directly into the tumor).</p>'
            ],
            [
                'title' => 'Chemotherapy',
                'description' => '<p><strong>Objective:</strong> Uses drugs to kill cancer cells or inhibit their growth.</p>
                                  <p><strong>Indications:</strong> Often used in combination with surgery and/or radiation therapy, especially for aggressive or recurrent tumors.</p>
                                  <p><strong>Types:</strong> Can be given orally or intravenously (IV), depending on the specific drugs used.</p>'
            ],
            [
                'title' => 'Targeted Therapy',
                'description' => '<p><strong>Objective:</strong> Targets specific molecules involved in tumor growth to block their function or destroy cancer cells selectively.</p>
                                  <p><strong>Indications:</strong> Used when tumors have specific genetic mutations or biomarkers that make them susceptible to targeted drugs.</p>
                                  <p><strong>Examples:</strong> EGFR inhibitors for certain types of gliomas.</p>'
            ],
            [
                'title' => 'Immunotherapy',
                'description' => '<p><strong>Objective:</strong> Boosts the body\'s immune system to better recognize and attack cancer cells.</p>
                                  <p><strong>Indications:</strong> Investigational in brain cancer but showing promise in clinical trials, particularly for recurrent or resistant tumors.</p>'
            ]
        ];
        

        DB::table('treatments')->insert($treatments);
    }
}