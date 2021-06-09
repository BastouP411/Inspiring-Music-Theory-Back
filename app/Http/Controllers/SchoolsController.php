<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    public function get(){
        return School::all();
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'bail|required|unique:schools',
            'address' => 'required'
        ]);

        $school = new \App\Models\School;
        $school->name = $request->name;
        $school->address = $request->address;
        $school->save();
        $response = ['message' => 'School saved in database'];
        return response($response, 200);
    }
}
