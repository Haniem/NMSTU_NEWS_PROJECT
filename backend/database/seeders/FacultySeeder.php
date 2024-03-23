<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;

use Database\Factories\FacultyFactory;

use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faculties')->insert([
            'faculty_name' => 'Кафедра Вычислительной Техники и Программирования (ВТиП)'
        ]);

        DB::table('faculties')->insert([
            'faculty_name' => 'Кафедра автоматизированных систем управления (АСУ)'
        ]);

        DB::table('faculties')->insert([
            'faculty_name' => 'Кафедра бизнес-информатики и информационных технологий (БИиИТ)'
        ]);

        DB::table('faculties')->insert([
            'faculty_name' => 'Кафедра информатики и информационной безопасности (ИиИБ)'
        ]);

        DB::table('faculties')->insert([
            'faculty_name' => 'Кафедра электроники и микроэлектроники (ЭиМ)'
        ]);
    }
}
