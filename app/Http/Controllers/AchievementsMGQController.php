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
            'mgq_id' => 'required|integer|exists:minigames_quizzes,id',
            'level' => 'integer|nullable',
            'score' => 'required|numeric',
            'evaluated' => 'required|boolean',
        ]);
        if ($validator->fails()){
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $data = $request->toArray();
        $data['user_id'] = $request->user()->id;
        $entry = AchievementMGQ::create($data);
        $entry->save();
        $response = ['message' => 'New entry added to database'];
        return response($response,200);
    }

    public function getMGQAdvancement(Request $request){
        $response = AchievementMGQ::where('user_id', $request['user_id'])->get();
        return response($response, 200);
    }

}
