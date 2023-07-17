<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Subject;
use Illuminate\Http\Request;

class libraryController extends Controller
{

    use AttachFilesTrait ;


    public function index()
    {
        $books = Library::all();
        return view('pages.Teachers.dashboard.library.index',compact('books'));
    }

    public function create()
    {
        $teacher_id = auth()->user()->id;
        $grades = Grade::all();
        $subjects = Subject::whereHas('teachers', function ($query) use ($teacher_id) {
            $query->where('teachers.id', $teacher_id);
        })->get();
        return view('pages.Teachers.dashboard.library.create',compact('grades','subjects'));

    }

    public function store(Request $request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->description = $request->description;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->classroom_id = $request->Classroom_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = auth()->user()->id;
            $books->subject_id= $request->subject_id;
            $books->save();
            $this->uploadFile($request,'file_name','library');

            flash()->addSuccess(trans('messages.success'));
            return redirect()->route('library_teacher.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $teacher_id = auth()->user()->id;
        $grades = Grade::all();
        $subjects = Subject::whereHas('teachers', function ($query) use ($teacher_id) {
            $query->where('teachers.id', $teacher_id);
        })->get();
        $book = library::findorFail($id);
        return view('pages.Teachers.dashboard.library.edit',compact('book','grades','subjects'));
    }

    public function update(Request $request)
    {
        try {
            $book = library::findorFail($request->id);

            if($request->hasfile('file_name')){

                $this->deleteFile($book->file_name,'library');

                $this->uploadFile($request,'file_name','library');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->title = $request->title;
            $book->description = $request->description;
            $book->Grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = auth()->user()->id;
            $book->subject_id= $request->subject_id;
            $book->save();
            flash()->addSuccess(trans('messages.Update'));
            return redirect()->route('library_teacher.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $this->deleteFile($request->file_name,'library');
        library::destroy($request->id);
        flash()->addWarning(trans('messages.Delete'));
        return redirect()->route('library_teacher.index');
    }

    public function library_teacher_attachment($filename)
    {
        return response()->download(public_path('attachments/library/'.$filename));
    }
}
