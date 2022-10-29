<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    use HasTranslations;
    public $translatable = ['Name_Section'];
    protected $fillable=['Name_Section','Grade_id','Status','Class_id'];

    protected $table = 'sections';
    public $timestamps = true;
// علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام
    public function My_class()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

    // علاقة الاقسام مع المعلمين
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','teacher_section');
    }
}
