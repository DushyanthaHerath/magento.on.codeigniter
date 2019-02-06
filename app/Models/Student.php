<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['firstname','lastname','gender','joined_date','teacher_id','class_room_id'];
    protected $guarded = [];

    /**
     * Get the class room belongs to student.
     */
    public function classRoom()
    {
        return $this->belongsTo('App\Models\ClassRoom','class_room_id','id');
    }
    
    /**
     * Get the teacher assigned to student.
     */
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher','teacher_id','id');
    }
}
