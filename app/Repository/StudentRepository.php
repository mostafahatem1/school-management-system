<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{
    use AttachFilesTrait;

    public function Get_Student()
    {
        $students = Student::all();
        return view('pages.Students.list', compact('students'));
    }

    public function Create_Student()
    {

        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationalities'] = Nationality::all();
        $data['bloods'] = Type_Blood::all();
        return view('pages.Students.add', $data);

    }

    public function Store_Student($request)
    {

        /// Check Two Tables Don't insert if Found Error Before insert
        DB::beginTransaction();
        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender = $request->gender;
            $students->nationality = $request->nationality;
            $students->blood = $request->blood;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;

            // insert   image

            if ($request->hasFile('image')) {
                // An image was uploaded

                $this->uploadFile($request, 'image', 'students');

                $students->image = $request->file('image')->getClientOriginalName();
            } else {
                // No image was uploaded
                $students->image = 'default.jpg';
            }


            $students->save();

            // insert   attachments
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/' . $students->name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id = $students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }
            DB::commit(); // insert data
            flash()->addSuccess(trans('messages.success'));
            return redirect()->route('students.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function Edit_Student($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationalities'] = Nationality::all();
        $data['bloods'] = Type_Blood::all();
        $Students = Student::findOrFail($id);
        return view('pages.Students.edit', $data, compact('Students'));
    }

    public function Update_Student($request)
    {
        try {
            $Edit_Students = Student::findorfail($request->id);
            // image
            if ($request->hasfile('image')) {
                // Delete the old image

                $this->deleteFile($Edit_Students->image, 'students');

                // A new image was uploaded
                $this->uploadFile($request, 'image', 'students');

                $file_name_new = $request->file('image')->getClientOriginalName();
                $Edit_Students->image = $Edit_Students->image !== $file_name_new ? $file_name_new : $Edit_Students->image;
            }


            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->password = Hash::make($request->password);
            $Edit_Students->gender = $request->gender;
            $Edit_Students->nationality = $request->nationality;
            $Edit_Students->blood = $request->blood;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            flash()->addSuccess(trans('messages.Update'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function Show_Student($id)
    {
        $Student = Student::findorfail($id);
        return view('pages.students.show', compact('Student'));
    }

    public function Delete_Student($request)
    {
        $this->deleteFile($request->image, 'students');
        Student::destroy($request->id);
        flash()->addWarning(trans('messages.Delete'));
        return redirect()->route('students.index');
    }

    public function Upload_attachment($request)
    {

        foreach ($request->file('photos') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/' . $request->student_name, $file->getClientOriginalName(), 'upload_attachments');

            // insert in image_table
            $images = new image();
            $images->filename = $name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        flash()->addSuccess(trans('messages.success'));
        return redirect()->route('students.show', $request->student_id);
    }

    public function Download_attachment($studentsname, $filename)
    {
        return response()->download(public_path('attachments/students/' . $studentsname . '/' . $filename));
    }

    public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->filename);

        // Delete in data
        image::where('id', $request->id)->where('filename', $request->filename)->delete();
        flash()->addWarning(trans('messages.Delete'));
        return redirect()->route('students.show', $request->student_id);
    }


}
