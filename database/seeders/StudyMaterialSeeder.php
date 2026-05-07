<?php

namespace Database\Seeders;

use App\Models\StudyMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudyMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
                'title' => 'Ancient History of Nepal',
                'category' => 'kharidar',
                'content' => 'The ancient history of Nepal is marked by the Kirat dynasty followed by the Lichhavi period. The Kirats are considered the earliest rulers of the Kathmandu valley. The Lichhavis introduced advanced administration and art. King Amshuverma was a famous ruler during this period who established relations with Tibet and China.',
            ],
            [
                'title' => 'Constitution of Nepal 2072',
                'category' => 'kharidar',
                'content' => 'The current Constitution of Nepal was promulgated on September 20, 2015 (Ashwin 3, 2072 BS). It establishes Nepal as a federal democratic republic. The constitution consists of 35 parts, 308 articles, and 9 schedules. It recognizes multi-ethnic, multi-lingual, and multi-cultural aspects of the nation.',
            ],
            [
                'title' => 'Geography of Nepal: Mountains & Rivers',
                'category' => 'nasu',
                'content' => 'Nepal is geographically divided into three regions: the Mountain region, the Hilly region, and the Terai region. The Himalayas in the north include Mount Everest, the highest peak in the world. Major river systems like Koshi, Gandaki, and Karnali originate from the mountains and flow southwards.',
            ]
        ];

        foreach ($materials as $m) {
            StudyMaterial::create([
                'title' => $m['title'],
                'slug' => Str::slug($m['title']),
                'category' => $m['category'],
                'content' => $m['content'],
                'type' => 'note',
                'is_active' => true,
            ]);
        }
    }
}
