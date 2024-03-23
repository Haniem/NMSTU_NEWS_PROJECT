<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            'tag_name' => 'Программирование',
            'get_count' => '0'
        ]);

        DB::table('tags')->insert([
            'tag_name' => 'Теплотехника',
            'get_count' => '0'
        ]);

        DB::table('tags')->insert([
            'tag_name' => 'C++',
            'get_count' => '0'
        ]);

        DB::table('tags')->insert([
            'tag_name' => 'Калитаев',
            'get_count' => '0'
        ]);

        DB::table('tags')->insert([
            'tag_name' => 'Информатика',
            'get_count' => '0'
        ]);
    }
}
