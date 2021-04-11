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
            'user_id' => 'required|integer|exists:users,id',
            'chapter_id' => 'required|integer|exists:chapters,id',
            'status' => ['required', 'integer', Rule::in([0, 1])],
        ]);
        if ($validator->fails()){
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $entry = AchievementChapters::create($request->toArray());
        $entry->save();
        $response = ['message' => 'New entry added to database'];
        return response($response,200);
    }
}
