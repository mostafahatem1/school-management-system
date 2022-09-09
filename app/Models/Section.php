<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    use HasTranslations;
    public $translatable = ['Name_Section'];
    protected $fillable=['Name_Section','Grade_id','Class_id'];

    protected $table = 'sections';
    public $timestamps = true;

    public function My_class()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

}
