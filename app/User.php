<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subject_teaches()
    {
        return $this->hasMany(Subject::class, 'lecturer_id');
    }

    public function subject_enrollee()
    {
        return $this->belongsToMany(Subject::class, 'subject_student', 'student_id', 'subject_id')
                    ->withPivot('quiz_1', 'quiz_2', 'quiz_3', 'assignment_1', 'assignment_2', 'assignment_3', 'midterm', 'final', 'possible_highest_mark', 'final_mark');
    }

    public function scopeStudent($query)
    {
        return $this->where('role_id', 3);
    }

    public function scopeLecturer($query)
    {
        return $this->where('role_id', 2);
    }
}
