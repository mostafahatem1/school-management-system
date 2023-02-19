<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{


  public function index()
  {
      $Grades=Grade::with('sections')->get();
      $list_Grades=Grade::all();
      $teachers= Teacher::all();
         return view('pages.sections.list',compact('Grades','list_Grades','teachers'));
  }


  public function create()
  {

  }

  public function store(StoreSections $request)
  {
       try {

      $Sections = new Section();

      $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
      $Sections->Grade_id = $request->Grade_id;
      $Sections->Class_id = $request->Class_id;
      $Sections->Status = 1;
      $Sections->save();
      $Sections->teachers()->syncWithoutDetaching($request->teacher_id);
      flash()->addSuccess(trans('messages.success'));

      return redirect()->route('sections.index');
  }

  catch (\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }

  }


  public function show($id)
  {

  }

  public function edit($id)
  {

  }


  public function update(StoreSections $request)
  {

      try {

          $Sections = Section::findOrFail($request->id);

          $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
          $Sections->Grade_id = $request->Grade_id;
          $Sections->Class_id = $request->Class_id;

          if(isset($request->Status)) {
              $Sections->Status = 1;
          } else {
              $Sections->Status = 2;
          }

          // update pivot tABLE
          if (isset($request->teacher_id)) {
              $Sections->teachers()->sync($request->teacher_id);
          } else {
              $Sections->teachers()->sync(array());
          }

          $Sections->save();
          flash()->addSuccess(trans('messages.Update'));

          return redirect()->route('sections.index');
      }
      catch
      (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }


  }

  public function destroy(Request $request)
  {

      Section::findOrFail($request->id)->delete();
      flash()->addWarning(trans('messages.Delete'));
      return redirect()->route('sections.index');

  }
  public function getclasses($id){

      $list_classes=Classroom::where("Grade_id",$id)->pluck("Name_Class","id");

      return $list_classes;
  }



}

?>
