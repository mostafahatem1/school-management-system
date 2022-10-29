<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{


  public function index()
  {
      $grades=Grade::all();
        return view('pages.grades.list',compact('grades'));
  }


  public function create()
  {

  }


  public function store(StoreGrades $request)
  {

       try {
           $Grades=new Grade();
           /*
               $translations = [
                   'en' => $request->Name_en,
                   'ar' => $request->Name
               ];
               $Grade->setTranslations('Name', $translations);
               */
           $Grades->Name = ['en' => $request->Name_en, 'ar' =>  $request->Name];
           $Grades->Notes=$request->Notes;
           $Grades->save();

           flash()->addSuccess(trans('messages.success'));

           return redirect()->route('grades.index');
       }
       catch (\Exception $e){
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }


  }

  public function edit($id)
  {

  }


  public function update(StoreGrades $request)
  {

      try {


          $Grades = Grade::findOrFail($request->id);
          $Grades->update([
              $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
              $Grades->Notes = $request->Notes,
          ]);
          flash()->addSuccess(trans('messages.Update'));
          return redirect()->route('grades.index');
      }
      catch
      (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
  }

  public function destroy(Request  $request)
  {
      $My_classes=Classroom::where('Grade_id',$request->id)->pluck('Grade_id');
      if($My_classes->count()==0){
          $Grades = Grade::findOrFail($request->id)->delete();
          flash()->addWarning(trans('messages.Delete'));
          return redirect()->route('grades.index');
      }else{
          flash()->addError(trans('grades_trans.delete_Grade_Error'));
          return redirect()->route('grades.index');
      }



  }

}

?>
