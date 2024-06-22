<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $diseases = [
            [
                'name' => 'Diabetes',
                'description' => 'A chronic disease that affects how your body turns food into energy.',
                'symptoms' => 'Increased thirst, frequent urination, extreme hunger, unexplained weight loss, presence of ketones in the urine, fatigue, irritability, blurred vision, slow-healing sores, frequent infections.',
                'treatment' => 'Monitoring blood sugar levels, insulin therapy, medications, lifestyle changes including diet and exercise.'
            ],
            [
                'name' => 'Hypertension',
                'description' => 'A condition in which the force of the blood against the artery walls is too high.',
                'symptoms' => 'Often has no symptoms, but it can cause serious problems such as heart attack, stroke, and kidney disease.',
                'treatment' => 'Medications, lifestyle changes such as a healthier diet, regular exercise, and quitting smoking.'
            ],
            [
                'name' => 'Asthma',
                'description' => 'A condition in which your airways narrow and swell and may produce extra mucus.',
                'symptoms' => 'Shortness of breath, chest tightness or pain, wheezing when exhaling, trouble sleeping caused by shortness of breath, coughing or wheezing attacks that are worsened by a respiratory virus.',
                'treatment' => 'Inhalers, steroids and other anti-inflammatory drugs, avoiding triggers.'
            ],
            [
                'name' => 'Influenza',
                'description' => 'A viral infection that attacks your respiratory system — your nose, throat, and lungs.',
                'symptoms' => 'Fever, chills, muscle aches, cough, congestion, runny nose, headaches, and fatigue.',
                'treatment' => 'Rest, fluids, antiviral medications.'
            ],
            [
                'name' => 'Migraine',
                'description' => 'A headache of varying intensity, often accompanied by nausea and sensitivity to light and sound.',
                'symptoms' => 'Intense throbbing or pulsing in one area of the head, nausea, vomiting, extreme sensitivity to light and sound.',
                'treatment' => 'Pain-relieving medications, preventive medications, lifestyle changes including stress management.'
            ],
          
            [
                'name' => 'Common Cold',
                'description' => 'A viral infection of your nose and throat (upper respiratory tract).',
                'symptoms' => 'Runny or stuffy nose, sore throat, cough, congestion, slight body aches or a mild headache, sneezing, low-grade fever.',
                'treatment' => 'Rest, fluids, over-the-counter cold remedies.'
            ],
            [
                'name' => 'Chickenpox',
                'description' => 'A highly contagious viral infection causing an itchy, blister-like rash on the skin.',
                'symptoms' => 'Fever, loss of appetite, headache, tiredness and malaise, rash.',
                'treatment' => 'Antiviral medications, calamine lotion, antihistamines.'
            ],
            [
                'name' => 'Malaria',
                'description' => 'A disease caused by a plasmodium parasite, transmitted by the bite of infected mosquitoes.',
                'symptoms' => 'Chills, fever, sweating, headache, nausea, vomiting, abdominal pain, diarrhea, muscle pain.',
                'treatment' => 'Antimalarial medications.'
            ],
            [
                'name' => 'Tuberculosis',
                'description' => 'A potentially serious infectious disease that mainly affects the lungs.',
                'symptoms' => 'Coughing that lasts three or more weeks, coughing up blood, chest pain, pain with breathing or coughing, unintentional weight loss, fatigue, fever, night sweats, chills, loss of appetite.',
                'treatment' => 'Antibiotic medications.'
            ],
            [
                'name' => 'Hepatitis B',
                'description' => 'A serious liver infection caused by the hepatitis B virus (HBV).',
                'symptoms' => 'Abdominal pain, dark urine, fever, joint pain, loss of appetite, nausea and vomiting, weakness and fatigue, yellowing of your skin and the whites of your eyes (jaundice).',
                'treatment' => 'Antiviral medications, liver transplant in severe cases.'
            ],
            [
                'name' => 'Alzheimer\'s Disease',
                'description' => 'A progressive disease that destroys memory and other important mental functions.',
                'symptoms' => 'Memory loss, confusion, difficulty understanding visual images, difficulty finding words, problems with speaking or writing.',
                'treatment' => 'Medications, management strategies for behavior, cognitive function, and daily living activities.'
            ],
            [
                'name' => 'Parkinson\'s Disease',
                'description' => 'A disorder of the central nervous system that affects movement, often including tremors.',
                'symptoms' => 'Tremor, slowed movement, rigid muscles, impaired posture and balance, loss of automatic movements, speech changes.',
                'treatment' => 'Medications, physical therapy, occupational therapy, surgical procedures.'
            ],
            [
                'name' => 'Epilepsy',
                'description' => 'A neurological disorder marked by sudden recurrent episodes of sensory disturbance, loss of consciousness, or convulsions, associated with abnormal electrical activity in the brain.',
                'symptoms' => 'Seizures, temporary confusion, a staring spell, uncontrollable jerking movements of the arms and legs, loss of consciousness or awareness, psychic symptoms.',
                'treatment' => 'Medications, surgery, dietary therapy, electrical stimulation of the vagus nerve.'
            ],
            [
                'name' => 'COPD (Chronic Obstructive Pulmonary Disease)',
                'description' => 'A chronic inflammatory lung disease that causes obstructed airflow from the lungs.',
                'symptoms' => 'Shortness of breath, wheezing, chest tightness, chronic cough, frequent respiratory infections, lack of energy.',
                'treatment' => 'Medications, oxygen therapy, pulmonary rehabilitation, lifestyle changes including smoking cessation.'
            ],
            [
                'name' => 'Rheumatoid Arthritis',
                'description' => 'A chronic inflammatory disorder affecting many joints, including those in the hands and feet.',
                'symptoms' => 'Tender, warm, swollen joints, joint stiffness that is usually worse in the mornings and after inactivity, fatigue, fever, and loss of appetite.',
                'treatment' => 'Medications, physical therapy, surgery, lifestyle changes including exercise and diet.'
            ],
            [
                'name' => 'Osteoporosis',
                'description' => 'A condition in which bones become weak and brittle.',
                'symptoms' => 'Back pain, caused by a fractured or collapsed vertebra, loss of height over time, a stooped posture, a bone that breaks much more easily than expected.',
                'treatment' => 'Medications, hormone-related therapy, weight-bearing exercises, dietary changes including calcium and vitamin D supplements.'
            ],
            [
                'name' => 'Psoriasis',
                'description' => 'A skin disease that causes red, itchy scaly patches, most commonly on the knees, elbows, trunk, and scalp.',
                'symptoms' => 'Red patches of skin covered with thick, silvery scales, dry, cracked skin that may bleed, itching, burning or soreness, thickened or ridged nails, swollen and stiff joints.',
                'treatment' => 'Topical treatments, phototherapy, systemic medications.'
            ],
            [
                'name' => 'Crohn\'s Disease',
                'description' => 'A type of inflammatory bowel disease (IBD) that may affect any part of the gastrointestinal tract from mouth to anus.',
                'symptoms' => 'Diarrhea, fever, fatigue, abdominal pain and cramping, blood in your stool, mouth sores, reduced appetite and weight loss, pain or drainage near or around the anus.',
                'treatment' => 'Anti-inflammatory drugs, immune system suppressors, antibiotics, nutrition therapy, surgery.'
            ],
            [
                'name' => 'Celiac Disease',
                'description' => 'An immune reaction to eating gluten, a protein found in wheat, barley, and rye.',
                'symptoms' => 'Diarrhea, fatigue, weight loss, bloating and gas, abdominal pain, nausea and vomiting, constipation.',
                'treatment' => 'Strict, lifelong gluten-free diet.'
            ],
            [
                'name' => 'Multiple Sclerosis',
                'description' => 'A disease in which the immune system eats away at the protective covering of nerves.',
                'symptoms' => 'Numbness or weakness in one or more limbs, electric-shock sensations that occur with certain neck movements, tremor, lack of coordination or unsteady gait, vision problems, slurred speech, fatigue, dizziness.',
                'treatment' => 'Medications to modify the course of the disease and manage symptoms, physical therapy, muscle relaxants, lifestyle changes.'
            ],
            [
                'name' => 'Lupus',
                'description' => 'A systemic autoimmune disease that occurs when your body\'s immune system attacks your own tissues and organs.',
                'symptoms' => 'Fatigue, fever, joint pain, stiffness and swelling, butterfly-shaped rash on the face that covers the cheeks and bridge of the nose, skin lesions that appear or worsen with sun exposure, fingers and toes that turn white or blue when exposed to cold or during stressful periods.',
                'treatment' => 'Medications, lifestyle changes, sun protection, diet, exercise.'
            ],
        ];

        foreach ($diseases as $disease) {
            Disease::create($disease);
        }
    }
}
