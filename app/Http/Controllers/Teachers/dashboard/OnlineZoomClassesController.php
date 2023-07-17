<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use App\Models\online_class;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineZoomClassesController extends Controller
{
    use MeetingZoomTrait;

    public function index()
    {
        $online_classes = online_class::where('created_by',auth()->user()->email)->get();
        return view('pages.Teachers.dashboard.online_classes.index', compact('online_classes'));
    }

    public function create()
    {
        $teacher_id = auth()->user()->id;
        $Grades = Grade::all();
        $subjects = Subject::whereHas('teachers', function ($query) use ($teacher_id) {
            $query->where('teachers.id', $teacher_id);
        })->get();
        return view('pages.Teachers.dashboard.online_classes.add', compact('Grades','subjects'));
    }

    public function indirectCreate()
    {
        $teacher_id = auth()->user()->id;
        $Grades = Grade::all();
        $subjects = Subject::whereHas('teachers', function ($query) use ($teacher_id) {
            $query->where('teachers.id', $teacher_id);
        })->get();
        return view('pages.Teachers.dashboard.online_classes.indirect', compact('Grades','subjects'));
    }

    public function store(Request $request)
    {
        try {

            $meeting = $this->createMeeting($request);
            online_class::create([
                'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            flash()->addSuccess(trans('messages.success'));
            return redirect()->route('online_zoom_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function storeIndirect(Request $request)
    {
        try {
            online_class::create([
                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            flash()->addSuccess(trans('messages.success'));
            return redirect()->route('online_zoom_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {
        try {

            $info = online_class::find($request->id);

            if($info->integration == true){
                Zoom::meeting()->find($request->meeting_id)->delete();
                online_class::destroy($request->id);

                // online_classe::where('meeting_id', $request->id)->delete();
            }
            else{
                online_class::destroy($request->id);
                // online_classe::where('id', $request->id)->delete();
            }
            flash()->addWarning(trans('messages.Delete'));
            return redirect()->route('online_zoom_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
