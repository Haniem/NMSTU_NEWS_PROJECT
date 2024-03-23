<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->insert([
            'specialization_name' => 'Программное обеспечение средств вычислительной техники и автоматизированных систем ',
            'acronym' => 'АВб-22-1',
            'faculty_id' => '1'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Проектирование и разработка Web-приложений',
            'acronym' => 'АВб-22-2',
            'faculty_id' => '1'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Логика и дизайн пользовательских интерфейсов ',
            'acronym' => 'АВб-22-3',
            'faculty_id' => '1'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Программное обеспечение для цифровизации предприятий и организаций',
            'acronym' => 'Авм-22',
            'faculty_id' => '1'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Системный анализ, управление и обработка информации',
            'acronym' => 'Ава-22-1',
            'faculty_id' => '1'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Автоматизация и управление технологическими процессами и производствами',
            'acronym' => 'Ава-22-2',
            'faculty_id' => '1'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Системы и средства автоматизации технологических процессов',
            'acronym' => 'АСб-22',
            'faculty_id' => '2'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Автоматизация технологических процессов и производств',
            'acronym' => 'АСм-22',
            'faculty_id' => '2'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Информационные системы и технологии в управлении ИТ-проектами',
            'acronym' => 'АПИб-22-2',
            'faculty_id' => '3'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Разработка компьютерных игр и приложений виртуальной/дополненной реальности',
            'acronym' => 'АПИб-22-1',
            'faculty_id' => '3'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Информатика и экономика',
            'acronym' => 'АПИб-22-3',
            'faculty_id' => '3'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Прикладная информатика в цифровой экономике',
            'acronym' => 'АПИм-22-1',
            'faculty_id' => '3'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Информационные технологии в образовании',
            'acronym' => 'АПОб-22',
            'faculty_id' => '3'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Технологии искусственного интеллекта в бизнесе',
            'acronym' => 'АПИм-22-2',
            'faculty_id' => '3'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Информационная безопасность автоматизированных систем',
            'acronym' => 'АИб-22-1',
            'faculty_id' => '4'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Программирование и электроника информационных систем',
            'acronym' => 'АЭб-22',
            'faculty_id' => '5'
        ]);

        DB::table('specializations')->insert([
            'specialization_name' => 'Промышленная электроника Индустрии 4.0',
            'acronym' => 'АЭм-22',
            'faculty_id' => '5'
        ]);
    }
}
