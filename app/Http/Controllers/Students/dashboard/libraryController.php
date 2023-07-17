<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\online_class;
use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class libraryController extends Controller
{

    public function index()
    {
        $grade_id = auth()->user()->Grade_id;
        $class_id = auth()->user()->Classroom_id;
        $subjects = Subject::where('grade_id',$grade_id)->where('classroom_id',$class_id)->get();
        return view('pages.Students.dashboard.library.index', compact('subjects'));
    }


    public function show($id)
    {
        $section_id = auth()->user()->section_id;

        $data['library'] = Library::where('subject_id',$id)->where('section_id',$section_id)->orderBy('id', 'DESC')->get();

        $data['quizzes'] = Quiz::where('subject_id',$id)->where('section_id',$section_id)->orderBy('id', 'DESC')->get();

        $data['online_classes'] = online_class::where('subject_id',$id)->where('section_id',$section_id)->orderBy('id', 'DESC')->get();

        return view('pages.Students.dashboard.library.show', $data);
    }


    public function library_student_attachment($filename)
    {
        return response()->download(public_path('attachments/library/'.$filename));
    }
}
