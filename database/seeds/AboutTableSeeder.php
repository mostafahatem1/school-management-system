<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abouts')->delete();

        $data = [
            ['key' => 'current_session', 'value' => '2022-2023'],
            ['key' => 'school_title', 'value' => 'Obour Future'],
            ['key' => 'school_name', 'value' => 'Obour Future International School'],
            ['key' => 'end_first_term', 'value' => '01-12-2022'],
            ['key' => 'end_second_term', 'value' => '01-03-2023'],
            ['key' => 'hot_line', 'value' => '33019'],
            ['key' => 'phone', 'value' => '0123456789'],
            ['key' => 'address', 'value' => 'القاهرة'],
            ['key' => 'school_email', 'value' => 'Obour_Future@gmail.com'],
            ['key' => 'logo', 'value' => '1.jpg'],
        ];

        DB::table('abouts')->insert($data);
    }
}
