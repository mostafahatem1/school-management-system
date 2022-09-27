<?php

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();

        $primaryStage = [
            ['en'=> 'First class', 'ar'=> 'الصف الأول'],
            ['en'=> 'Second class', 'ar'=> 'الصف الثاني'],
            ['en'=> 'third class', 'ar'=> 'الصف الثالث'],
            ['en'=> 'Fourth class', 'ar'=> 'لصف الرابع'],
            ['en'=> 'Fifth class', 'ar'=> 'الصف الخامس'],
            ['en'=> 'Sixth class', 'ar'=> 'الصف السادس'],

        ];
        foreach ($primaryStage as $p) {
            Classroom::create(['Name_Class' => $p, 'Grade_id' => 1]);
        }

        $middleSchool = [
            ['en'=> 'First class', 'ar'=> 'الصف الأول'],
            ['en'=> 'Second class', 'ar'=> 'الصف الثاني'],
            ['en'=> 'third class', 'ar'=> 'الصف الثالث'],


        ];
        foreach ($middleSchool as $m) {
            Classroom::create(['Name_Class' => $m, 'Grade_id' => 2]);
        }

        foreach ($middleSchool as $m) {
            Classroom::create(['Name_Class' => $m, 'Grade_id' => 3]);
        }




    }
}
