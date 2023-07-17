<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{
    use AttachFilesTrait;

    public function getAllTeachers()
    {
        // TODO: Implement getAllTeachers() method.
        return Teacher::all();
    }

    public function Getspecialization()
    {
        return Specialization::all();
    }

    public function GetGender()
    {
        return Gender::all();
    }

    public function StoreTeachers($request)
    {
        try {
            $Teachers = new Teacher();
            $Teachers->email = $request->Email;
            $Teachers->password = Hash::make($request->Password);
            $Teachers->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $Teachers->specialization = $request->specialization;
            $Teachers->gender = $request->gender;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->address = $request->address;

            // insert   image

            if ($request->hasFile('image')) {

                // An image was uploaded
                $this->uploadFile($request,'image','teachers');
                $Teachers->image =$request->file('image')->getClientOriginalName();

            } else {
                // No image was uploaded
                $Teachers->image = 'default.jpg';
            }

            $Teachers->save();
            flash()->addSuccess(trans('messages.success'));
            return redirect()->route('teachers.create');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function editTeachers($id)
    {
        $Teachers = Teacher::findOrFail($id);
        $specializations = $this->Getspecialization();
        $genders = $this->GetGender();
        return view('pages.Teachers.Edit', compact('Teachers', 'specializations', 'genders'));
    }

    public function UpdateTeachers($request)
    {
        try {
            $Teacher = Teacher::findOrFail($request->id);

            $image = $Teacher->image; // set a default value for $image

            if ($request->hasfile('image')) {
                // Delete the old image
                $this->deleteFile($Teacher->image, 'teachers');

                // A new image was uploaded
                $this->uploadFile($request, 'image', 'teachers');

                $file_name_new = $request->file('image')->getClientOriginalName();
                $image = $Teacher->image !== $file_name_new ? $file_name_new : $Teacher->image;
            }

            $Teacher->update([
                'email'=>$request->Email,
                'password'=>Hash::make($request->Password),
                'image' => $image,
                'name'=>['en' => $request->name_en, 'ar' => $request->name_ar],
                'specialization'=>$request->specialization,
                'gender'=>$request->gender,
                'Joining_Date'=>$request->Joining_Date,
                'address'=>$request->address,
            ]);
            flash()->addSuccess(trans('messages.Update'));
            return redirect()->route('teachers.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function DeleteTeachers($request)
    {
        $this->deleteFile($request->image, 'teachers');
        Teacher::find($request->id)->delete();
        flash()->addWarning(trans('messages.Delete'));
        return redirect()->route('teachers.index');
    }
}
