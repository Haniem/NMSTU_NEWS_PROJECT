<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            'type_name' => 'Статья'
        ]);

        DB::table('types')->insert([
            'type_name' => 'Рецензия'
        ]);

        DB::table('types')->insert([
            'type_name' => 'Подкаст'
        ]);

        DB::table('types')->insert([
            'type_name' => 'Опрос'
        ]);

        DB::table('types')->insert([
            'type_name' => 'Отчёт'
        ]);
    }
}
