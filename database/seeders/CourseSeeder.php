<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Section Officer',
            'Nayab Subba (Na.Su.)',
            'Kharidar',
            'Health Assistant',
            'Staff Nurse',
            'ANM',
            'Lab Technician',
            'Agricultural Officer',
            'Forest Guard',
            'Computer Operator',
            'Accountant',
            'Education Officer',
            'Bagmati Province Exam',
            'Lumbini Province Exam',
            'Koshi Province Exam',
            'Madhesh Province Exam',
            'Gandaki Province Exam',
            'Karnali Province Exam',
            'Sudurpashchim Province Exam',
        ];

        foreach ($services as $service) {
            Course::updateOrCreate(
                ['slug' => Str::slug($service)],
                ['title' => $service, 'is_active' => true]
            );
        }
    }
}
