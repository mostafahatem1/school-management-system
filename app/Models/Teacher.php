<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded=[];



    // علاقة المعلمين مع الاقسام
    public function Sections()
    {
        return $this->belongsToMany('App\Models\Section','teacher_section');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'subject_teacher');
    }

    public function quizzies()
    {
        return $this->hasMany(Quiz::class, 'quiz_id');
    }
}
