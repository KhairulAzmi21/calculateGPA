<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'subject_id');
    }
}
