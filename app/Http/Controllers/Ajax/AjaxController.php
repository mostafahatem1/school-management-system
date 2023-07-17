<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function Get_classrooms($id){
        if(auth('teacher')->check()){

            $section_id = DB::table('teacher_section')->where('teacher_id',auth('teacher')->user()->id)->pluck('section_id');
            $list_classes =  Classroom::whereHas('sections', function ($query) use ($section_id) {
                $query->whereIn('sections.id', $section_id);
            })->where("Grade_id", $id)->pluck('Name_Class', 'id');

        }elseif (auth('web')->check()){
            $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
        }

        return $list_classes;
    }


    //Get Sections
    public function Get_Sections($id){



        if(auth('teacher')->check()){

            $teacher_id = auth('teacher')->user()->id;
            $list_sections = Section::whereHas('teachers', function ($query) use ($teacher_id) {
                $query->where('teachers.id', $teacher_id);
            })->where("Class_id", $id)->pluck("Name_Section", "id");

        }elseif (auth('web')->check()){
            $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        }

        return $list_sections;
    }
}
