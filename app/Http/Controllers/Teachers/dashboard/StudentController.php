<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index()
    {
        $section_id = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $students=Student::whereIn('section_id',$section_id)->get();
        return view('pages.Teachers.dashboard.students.index',compact('students'));
    }

   public function sections(){
       $section_id = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
       $sections=Section::whereIn('id',$section_id)->get();
       return view('pages.Teachers.dashboard.sections.index', compact('sections'));

   }
    public function attendance(Request $request)
    {

        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::updateorCreate([
                    'student_id'=>$studentid,
                    'attendence_date' => date('Y-m-d')
                ],[
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => auth()->user()->id,
                    'attendence_date' => date('Y-m-d'),
                    'attendence_status' => $attendence_status
                ]);
            }
            flash()->addSuccess(trans('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function attendanceReport(){

        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('pages.Teachers.dashboard.students.attendance_report', compact('students'));

    }

    public function attendanceSearch(Request $request)
    {

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => __('Teacher_trans.The_end_date_the_start_date'),
            'from.date_format' => __('Teacher_trans.date_format'),
            'to.date_format' => __('Teacher_trans.date_format'),
        ]);


        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.Teachers.dashboard.students.attendance_report', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.Teachers.dashboard.students.attendance_report', compact('Students', 'students'));


        }
    }


}
