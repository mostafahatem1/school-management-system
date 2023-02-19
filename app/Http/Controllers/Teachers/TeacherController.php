<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Http\Requests\UpdateTeachers;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
        return view('pages.Teachers.list',compact('Teachers'));

    }


    public function create()
    {
        $specializations = $this->Teacher->Getspecialization() ;
        $genders =$this->Teacher->GetGender() ;
        return view('pages.Teachers.create',compact('specializations','genders'));
    }


    public function store(StoreTeachers $request)
    {

        return $this->Teacher->StoreTeachers($request);

    }


    public function show(Teacher $teacher)
    {
        //
    }


    public function edit($id)
    {
        return $this->Teacher->editTeachers($id);
    }


    public function update(UpdateTeachers $request)
    {
        return $this->Teacher->UpdateTeachers($request);
    }

    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeachers($request);
    }
}
