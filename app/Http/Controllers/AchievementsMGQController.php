<?php

namespace App\Http\Controllers;

use App\Models\AchievementMGQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AchievementsMGQController extends Controller
{
    public function newEntry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'mgq_id' => 'required|integer|exists:minigames_quizzes,id',
            'level' => 'integer|nullable',
            'score' => 'required|numeric',
            'evaluated' => 'required|boolean',
        ]);
        if ($validator->fails()){
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $entry = AchievementMGQ::create($request->toArray());
        $entry->save();
        $response = ['message' => 'New entry added to database'];
        return response($response,200);
    }
}
