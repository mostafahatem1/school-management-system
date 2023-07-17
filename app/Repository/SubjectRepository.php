<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectRepositoryInterface
{
    use AttachFilesTrait ;


    public function index()
    {
        $subjects = Subject::get();
        return view('pages.Subjects.index',compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.create',compact('grades','teachers'));
    }

    public function store($request)
    {
        try {
            $subjects = new Subject();
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->file_name =  $request->file('file_name')->getClientOriginalName();
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Classroom_id;
            $subjects->save();
            $subjects->teachers()->syncWithoutDetaching($request->teacher_id);
            $this->uploadFile($request,'file_name','subjects');
            flash()->addSuccess(trans('messages.success'));
            return redirect()->route('subjects.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $subject =Subject::findorfail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.edit',compact('subject','grades','teachers'));
    }

    public function update($request)
    {
        try {
            $subjects =  Subject::findorfail($request->id);

            if($request->hasfile('file_name')){

                $this->deleteFile($subjects->file_name,'subjects');

                $this->uploadFile($request,'file_name','subjects');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $subjects->file_name = $subjects->file_name !== $file_name_new ? $file_name_new : $subjects->file_name;
            }

            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Classroom_id;
            $subjects->save();
            if (isset($request->teacher_id)) {
                $subjects->teachers()->sync($request->teacher_id);
            } else {
                $subjects->teachers()->sync(array());
            }
            flash()->addSuccess(trans('messages.Update'));
            return redirect()->route('subjects.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            $this->deleteFile($request->file_name,'subjects');
            Subject::destroy($request->id);
            flash()->addWarning(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
