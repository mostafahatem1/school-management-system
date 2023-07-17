<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class subjectsController extends Controller
{
    public function index()
    {
        $teacherId = auth()->user()->id ;
        $subjects = Subject::whereHas('teachers', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->get();
        return view('pages.Teachers.dashboard.Subjects.index',compact('subjects'));
    }

}
