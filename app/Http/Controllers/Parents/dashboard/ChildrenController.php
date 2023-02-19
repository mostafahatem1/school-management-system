<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Students\FeeInvoiceController;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\FeeInvoice;
use App\Models\ReceiptStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function attendances(){
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parents.dashboard.Attendance.index', compact('students'));
    }

    public function attendanceSearch(Request $request){

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => __('Teacher_trans.The_end_date_the_start_date'),
            'from.date_format' => __('Teacher_trans.date_format'),
            'to.date_format' => __('Teacher_trans.date_format'),
        ]);


        $students = Student::where('parent_id', auth()->user()->id)->get();

        $students_id = $students->pluck('id');


        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->whereIn('student_id',$students_id)->get();
            return view('pages.parents.dashboard.Attendance.index', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->whereIn('student_id',$students_id)->get();
            return view('pages.parents.dashboard.Attendance.index', compact('Students', 'students'));


        }
    }


    public function fees(){
        $students_ids = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $Fee_invoices = FeeInvoice::whereIn('student_id',$students_ids)->get();
        return view('pages.parents.dashboard.fee.index', compact('Fee_invoices'));

    }

    public function receiptStudent($id){

        $student = Student::findorFail($id);
        if ($student->parent_id !== auth()->user()->id) {
            flash()->addError(trans('Parent_trans.error_student_code'));
            return redirect()->route('sons.fees');
        }

        $receipt_students = ReceiptStudent::where('student_id',$id)->get();

        if ($receipt_students->isEmpty()) {
            flash()->addError(trans('Parent_trans.no_results_student'));
            return redirect()->route('sons.fees');
        }
        return view('pages.parents.dashboard.Receipt.index', compact('receipt_students'));

    }
}
