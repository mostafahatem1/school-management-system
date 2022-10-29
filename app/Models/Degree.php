<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $guarded = [];
    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz', 'quiz_id');
    }
}
