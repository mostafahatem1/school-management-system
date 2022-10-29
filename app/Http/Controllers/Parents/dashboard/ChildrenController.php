<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function index()
    {

        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parents.dashboard.children.index', compact('students'));
    }
    public function results($id)
    {

        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            flash()->addError(trans('Parent_trans.error_student_code'));
            return redirect()->route('sons.index');
        }

        $degrees = Degree::where('student_id', $id)->get();
        if ($degrees->isEmpty()) {
            flash()->addError(trans('Parent_trans.no_results_student'));
            return redirect()->route('sons.index');
        }

        return view('pages.parents.dashboard.degrees.index', compact('degrees'));

    }
}
