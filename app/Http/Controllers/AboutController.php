<?php

namespace App\Http\Controllers;

use App\Http\Traits\AttachFilesTrait;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use AttachFilesTrait;
    public function index(){

        $collection = About::all();
        $setting['about'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('pages.Abouts.index', $setting);
    }
    public function update(Request $request){

        try{
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key=> $value){
                About::where('key', $key)->update(['value' => $value]);
            }

//            $key = array_keys($info);
//            $value = array_values($info);
//            for($i =0; $i<count($info);$i++){
//                Setting::where('key', $key[$i])->update(['value' => $value[$i]]);
//            }

            if($request->hasFile('logo')) {
                ///  Delete logo from disk
                $old_logo_name = About::where('key', 'logo')->pluck('value')->first();
                $this->deleteFile($old_logo_name ,'logo');

                // form request('logo') Update logo on disk  and Database
                $new_logo_name = $request->file('logo')->getClientOriginalName();
                About::where('key', 'logo')->update(['value' => $new_logo_name]);
                $this->uploadFile($request,'logo','logo');


            }

            flash()->addSuccess(trans('messages.Update'));
            return back();
        }
        catch (\Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
