<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $Grades=Grade::with('sections')->get();
      $list_Grades=Grade::all();
         return view('pages.sections.list',compact('Grades','list_Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreSections $request)
  {
       try {

      $Sections = new Section();

      $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
      $Sections->Grade_id = $request->Grade_id;
      $Sections->Class_id = $request->Class_id;
      $Sections->Status = 1;
      $Sections->save();
      flash()->addSuccess(trans('messages.success'));

      return redirect()->route('sections.index');
  }

  catch (\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }

  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
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

          $Sections->save();
          flash()->addSuccess(trans('messages.Update'));

          return redirect()->route('sections.index');
      }
      catch
      (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }


  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
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
