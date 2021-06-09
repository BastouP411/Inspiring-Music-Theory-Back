<?php

namespace App\Http\Controllers;

use App\Models\AchievementChapters;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AchievementsChaptersController extends Controller
{
    public function newEntry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chapter_id' => 'required|integer|exists:chapters,id',
            'status' => ['required', 'integer', Rule::in([0, 1])],
        ]);
        if ($validator->fails()){
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $data = $request->toArray();
        $data['user_id'] = $request->user()->id;
        $entry = AchievementChapters::create($data);
        $entry->save();
        $response = ['message' => 'New entry added to database'];
        return response($response,200);
    }

    public function getChaptersAdvancement(Request $request){
        $response = AchievementChapters::where('user_id', $request['user_id'])->get();
        return response($response, 200);
    }

}
