<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            'position_name' => 'Студент'
        ]);

        DB::table('positions')->insert([
            'position_name' => 'Преподаватель'
        ]);

        DB::table('positions')->insert([
            'position_name' => 'Ректор'
        ]);

        DB::table('positions')->insert([
            'position_name' => 'Директор'
        ]);

        DB::table('positions')->insert([
            'position_name' => 'Заведующий кафедрой'
        ]);

        DB::table('positions')->insert([
            'position_name' => 'Административный персонал'
        ]);

        DB::table('positions')->insert([
            'position_name' => 'Куратор'
        ]);
    }
}
