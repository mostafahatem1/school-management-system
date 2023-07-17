<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //==============================================sections==========================================================//
    public function sections()
    {
        $section_id = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id', $section_id)->get();
        return view('pages.Teachers.dashboard.sections.index', compact('sections'));

    }

    //==============================================attendanceStudent==========================================================//
    public function index()
    {
        $section_id = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');

        // get sections for student
        $Grades = Grade::with(['Sections' => function ($query) use ($section_id) {
            $query->whereIn('Sections.id', $section_id);
        }])->get();
        return view('pages.Teachers.dashboard.students.sections', compact('Grades'));
    }

    public function show($id)
    {
        $students = Student::with('attendances')->where('section_id', $id)->get();
        return view('pages.Teachers.dashboard.students.index', compact('students'));
    }

    //=====================================attendanceReport==========================================================//

    public function attendance(Request $request)
    {

        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                $attendance = Attendance::whereHas('students', function ($query) use ($studentid) {
                    $query->where('students.id', $studentid);
                })->where('attendence_date', date('Y-m-d'))
                    ->first();

                if ($attendance) {
                    $attendance->attendence_status = $attendence_status;
                    $attendance->save();
                } else {
                    $attendance = Attendance::create([
                        'teacher_id' => auth()->user()->id,
                        'attendence_date' => date('Y-m-d'),
                        'attendence_status' => $attendence_status
                    ]);
                    $attendance->students()->attach($studentid);
                }

            }
            flash()->addSuccess(trans('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function attendanceReport()
    {

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

            $StudentsAttendance = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->where('teacher_id', auth()->user()->id)->get();
            return view('pages.Teachers.dashboard.students.attendance_report', compact('StudentsAttendance', 'students'));
        } else {

            $StudentsAttendance = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->whereHas('students', function ($query) use ($request) {
                    $query->where('students.id', $request->student_id);
                })
                ->where('teacher_id', auth()->user()->id)
                ->get();

            return view('pages.Teachers.dashboard.students.attendance_report', compact('StudentsAttendance', 'students'));


        }
    }


}
