<?php
namespace App\Repository;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getAllTeachers()
    {
        // TODO: Implement getAllTeachers() method.
        return Teacher::all();
    }

    public function Getspecialization(){
        return Specialization::all();
    }

    public function GetGender(){
        return Gender::all();
    }

    public function StoreTeachers($request){
        try {
            $Teachers = new Teacher();
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            flash()->addSuccess(trans('messages.success'));
            return redirect()->route('teachers.create');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function editTeachers($id){
        $Teachers = Teacher::findOrFail($id);
        $specializations = Specialization::all();
        $genders = Gender::all();
        return view('pages.Teachers.Edit',compact('Teachers','specializations','genders'));
    }

    public function UpdateTeachers($request){
        try {
        $Teacher = Teacher::findOrFail($request->id);
        $Teacher->update($request->all());
            flash()->addSuccess(trans('messages.Update'));
            return redirect()->route('teachers.index');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function DeleteTeachers($request){
        Teacher::find($request->id)->delete();
        flash()->addWarning(trans('messages.Delete'));
        return redirect()->route('teachers.index');
    }
}
