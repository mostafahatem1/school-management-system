<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class online_class extends Model
{
    //protected $guarded=[];
    public $fillable= ['integration','Grade_id','Classroom_id','section_id','created_by','subject_id','meeting_id','topic','start_at','duration','password','start_url','join_url'];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

}
