<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{


  public function index()
  {
      $My_Classes = Classroom::all();
      $grades = Grade::all();
      return view('pages.My_Classes.list', compact('My_Classes', 'grades'));

  }


  public function create()
  {


  }


  public function store(StoreClassroom $request)
  {
      $List_Classes = $request->List_Classes;

      try {

          foreach ($List_Classes as $List_Class) {

              $My_Classes = new Classroom();

              $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];

              $My_Classes->Grade_id = $List_Class['Grade_id'];

              $My_Classes->save();

          }

          flash()->addSuccess(trans('messages.success'));
          return redirect()->route('Classrooms.index');
      } catch (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

  }


  public function show($id)
  {

  }


  public function edit($id)
  {

  }


  public function update(StoreClassroom $request)
  {
      try {

          $My_Class = Classroom::findOrFail($request->id);
          $My_Class->update([
              $My_Class->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_en],
              $My_Class->Grade_id = $request->Grade_id,
          ]);
          flash()->addSuccess(trans('messages.Update'));
          return redirect()->route('Classrooms.index');
      }
      catch
      (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
  }


  public function destroy(Request  $request)
  {
      $My_Class = Classroom::findOrFail($request->id)->delete();
      flash()->addWarning(trans('messages.Delete'));
      return redirect()->route('Classrooms.index');

  }
    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        flash()->addWarning(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }
    public function Filter_Classes(Request $request)
    {
        if ($request->Grade_id == 0){
            return redirect()->route('Classrooms.index');
        }else{
            $grades = grade::all();
            $Search = Classroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();
         return view('pages.My_Classes.list',compact('grades'))->withDetails($Search);

        }

    }

}

?>
