<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TumorSeeder extends Seeder{
    public function run(): void{
        $tumors = [
            [
                'title' => 'Astrocytoma Tumor',
                'description' => '<p><strong>Description:</strong> Astrocytomas are primary brain tumors originating from astrocytes, a type of glial cell that supports neurons. They are classified based on their histopathological features and proliferative potential.</p>
                                  <p><strong>Classification:</strong> According to the World Health Organization (WHO), astrocytomas are graded from I to IV:</p>
                                  <ul>
                                      <li>Grade I (Pilocytic Astrocytoma): Generally benign and slow-growing, often occurring in children and young adults.</li>
                                      <li>Grade II (Diffuse Astrocytoma): Infiltrative and slow-growing, with a tendency to progress to higher grades.</li>
                                      <li>Grade III (Anaplastic Astrocytoma): Malignant and more aggressive, with increased cellularity and mitotic activity.</li>
                                      <li>Grade IV (Glioblastoma Multiforme, GBM): Highly aggressive and malignant, characterized by rapid growth, necrosis, and vascular proliferation.</li>
                                  </ul>
                                  <p><strong>Treatment:</strong> Options vary by grade and location but may include surgical resection, radiotherapy, and chemotherapy. Temozolomide is commonly used for high-grade astrocytomas, particularly GBM.</p>',
                'picture' => '/path/to/images/astrocytoma.jpg'
            ],
            [
                'title' => 'Glioblastoma Multiforme (GBM)',
                'description' => '<p><strong>Description:</strong> GBM is the most aggressive and common malignant primary brain tumor in adults, classified as a WHO Grade IV astrocytoma.</p>
                                  <p><strong>Classification:</strong> Features include heterogeneous tissue, necrosis, microvascular proliferation, and a high rate of mitosis. GBMs are known for their rapid growth and infiltration into surrounding brain tissue.</p>
                                  <p><strong>Genetic Profile:</strong> Common genetic alterations include mutations in the TP53, EGFR, and PTEN genes, as well as amplification of the MDM2 gene and deletions in chromosome 10.</p>
                                  <p><strong>Treatment:</strong> Standard care includes maximal safe surgical resection followed by concurrent radiotherapy and temozolomide chemotherapy. Bevacizumab is sometimes used for recurrent GBM. Despite aggressive treatment, median survival remains around 15-18 months.</p>',
                'picture' => '/path/to/images/gbm.jpg'
            ],
            [
                'title' => 'Medulloblastoma Tumor',
                'description' => '<p><strong>Description:</strong> Medulloblastoma is a highly malignant primary brain tumor that originates in the cerebellum or posterior fossa. It is most commonly diagnosed in children.</p>
                                  <p><strong>Classification:</strong> Medulloblastomas are classified into four molecular subgroups: WNT, SHH, Group 3, and Group 4, each with distinct genetic and clinical features.</p>
                                  <p><strong>Characteristics:</strong> The tumor typically presents with symptoms of increased intracranial pressure, such as headaches and vomiting, due to blockage of cerebrospinal fluid flow.</p>
                                  <p><strong>Treatment:</strong> Multimodal therapy includes surgical resection, craniospinal irradiation, and chemotherapy. The prognosis varies by molecular subgroup, with WNT-associated tumors having the best outcome.</p>',
                'picture' => '/path/to/images/medulloblastoma.jpg'
            ],
            [
                'title' => 'Meningioma Tumor',
                'description' => '<p><strong>Description:</strong> Meningiomas originate from the meninges, the membranous layers surrounding the brain and spinal cord. They are typically slow-growing and benign.</p>
                                  <p><strong>Classification:</strong> According to the WHO, meningiomas are graded as:</p>
                                  <ul>
                                      <li>Grade I: Benign, slow-growing, and the most common type.</li>
                                      <li>Grade II (Atypical Meningioma): Intermediate, with a higher risk of recurrence.</li>
                                      <li>Grade III (Anaplastic/Malignant Meningioma): Rare and highly aggressive.</li>
                                  </ul>
                                  <p><strong>Characteristics:</strong> Symptoms depend on the tumor\'s location and may include headaches, seizures, and neurological deficits.</p>
                                  <p><strong>Treatment:</strong> Management often involves surgical resection, with the extent of removal being a critical factor in recurrence. Radiotherapy or stereotactic radiosurgery is considered for atypical or anaplastic meningiomas or for residual/recurrent tumors.</p>',
                'picture' => '/path/to/images/meningioma.jpg'
            ],
            [
                'title' => 'Pituitary Tumor',
                'description' => '<p><strong>Description:</strong> Pituitary adenomas are benign tumors arising from the pituitary gland. They are classified based on their size (microadenomas &lt;1 cm, macroadenomas &gt;1 cm) and hormone secretion status (functioning or non-functioning).</p>
                                  <p><strong>Types:</strong> Common types include prolactinomas, growth hormone-secreting adenomas (causing acromegaly), and ACTH-secreting adenomas (causing Cushing\'s disease).</p>
                                  <p><strong>Classification:</strong> Functioning adenomas present with symptoms related to hormone hypersecretion, while non-functioning adenomas may cause symptoms by compressing surrounding structures, such as headaches and vision changes.</p>
                                  <p><strong>Treatment:</strong> Depending on the tumor type, treatment may include medical management (e.g., dopamine agonists for prolactinomas), surgical resection (often via a transsphenoidal approach), and radiotherapy for residual or recurrent tumors.</p>',
                'picture' => '/path/to/images/pituitary.jpg'
            ],
            [
                'title' => 'Choroid Plexus Tumor',
                'description' => '<p><strong>Description:</strong> Choroid plexus tumors originate from the choroid plexus epithelium, which produces cerebrospinal fluid. They are rare and can be benign (choroid plexus papilloma) or malignant (choroid plexus carcinoma).</p>
                                  <p><strong>Classification:</strong></p>
                                  <ul>
                                      <li>Choroid Plexus Papilloma (CPP): WHO Grade I, benign, and more common in children.</li>
                                      <li>Atypical Choroid Plexus Papilloma (ACPP): WHO Grade II, intermediate malignancy.</li>
                                      <li>Choroid Plexus Carcinoma (CPC): WHO Grade III, highly malignant, and aggressive.</li>
                                  </ul>
                                  <p><strong>Characteristics:</strong> Symptoms often relate to increased intracranial pressure due to obstructed cerebrospinal fluid flow, such as hydrocephalus, headaches, and vomiting.</p>
                                  <p><strong>Treatment:</strong> Primary treatment is surgical resection. Complete removal is often curative for CPP, while CPC may require adjuvant chemotherapy and radiotherapy. Prognosis depends on the extent of surgical resection and tumor grade.</p>',
                'picture' => '/path/to/images/choroid_plexus.jpg'
            ]
        ];

        DB::table('tumors')->insert($tumors);
    }
}