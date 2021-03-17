<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getAll(){
        $response = User::all();
        return response($response, 200);
    }

    public function updateRights(Request $request){
        $id = $request['id'];
        $user = User::where('id', $id)->update(['type' => 1]);
        if($user){
            $response = ['message' => 'Succeeded'];
            return response($response, 200);
        }
        else{
            $response = ['message' => 'An error occurred during update'];
            return response($response, 500);
        }
    }
}
