<?php

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();

        $grades = [
            ['en'=> 'Primary stage', 'ar'=> 'المرحله الابتدائية'],
            ['en'=> 'middle School', 'ar'=> 'المرحله الاعداديه'],
            ['en'=> 'High school', 'ar'=> 'المرحله الثانويه'],

        ];
        foreach ($grades as $g) {
           Grade::create(['Name' => $g]);
        }
    }
}
