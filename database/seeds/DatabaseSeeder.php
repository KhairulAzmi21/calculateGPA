<?php

use Illuminate\Database\Seeder;
use App\Subject;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\User', 1)->create(['role_id' => 1]);
        $lecturers = factory('App\User', 5)->create(['role_id' => 2]);
        $students = factory('App\User', 70)->create(['role_id' => 3]);

        $lecturers->each(function ($lecturer) {
            factory('App\Subject', 3)->create(['lecturer_id' => $lecturer->id ]);
        });

        $subjects = App\Subject::get();

        $students->each(function ($student) use ($subjects) {
            $student->subject_enrollee()->attach($subjects->pluck('id')->take(rand(1, $subjects->count())));
        });
    }
}
