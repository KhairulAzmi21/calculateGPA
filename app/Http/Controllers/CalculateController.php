<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CalculateController extends Controller
{
    public function calculate()
    {
        //select random student
        $user = User::student()->first();

        //select specific subject
        $subject_taken = $user->subject_enrollee()->where('subject_id', 1)->first();

        // lecturer submit quiz_1
        $no1 = true;
        // lecturer submit quiz 2
        $no2 = true;

        // possible highest mark .
        $possible_highest_mark = 100;

        $total_mark = 0;

        //kalau ada input quiz_1 , update quiz 1
        if ($no1) {
            $user->subject_enrollee()->updateExistingPivot($subject_taken->id, ['quiz_1' => "10,15"]);
            $subject_taken = $user->subject_enrollee()->where('subject_id', 1)->first();
            // possible dah bertukar
            // contoh quiz 1 , full mark is 15, tp student tp 10, so 5 markah dah hilang .
            // so calculation dia 100-(15-10) = 95 possible highest mark .
            $possible_highest_mark = $possible_highest_mark - (explode(",", $subject_taken->pivot->quiz_1)[1] - explode(",", $subject_taken->pivot->quiz_1)[0]);
            $total_mark =  $total_mark + explode(",", $subject_taken->pivot->quiz_1)[0];
        }
        //kalau ada input quiz_2 , update quiz 2
        if ($no2) {
            $user->subject_enrollee()->updateExistingPivot($subject_taken->id, ['quiz_2' => "5,10"]);
            $subject_taken = $user->subject_enrollee()->where('subject_id', 1)->first();
            $possible_highest_mark = $possible_highest_mark - (explode(",", $subject_taken->pivot->quiz_2)[1] - explode(",", $subject_taken->pivot->quiz_2)[0]);
            $total_mark =  $total_mark + explode(",", $subject_taken->pivot->quiz_2)[0];
        }
        // last sekali update possible highest mark
        $user->subject_enrollee()->updateExistingPivot($subject_taken->id, ['possible_highest_mark' => $possible_highest_mark]);

        dump($possible_highest_mark, $total_mark);

        return $subject_taken;
    }
}
