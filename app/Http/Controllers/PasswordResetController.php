<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function sendMail(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);

        if ($validator->fails()){
            return response(['message' => $validator->errors()->all()]);
        }

        $email = $request['email'];

        $newPassword = str_random(10);

        $request['new_password'] = $newPassword;

        $details = [
            'title' => 'Réinitialisation de votre mot de passe sur Diesy',
            'body' => 'Vous avez réinitialiser votre mot de passe. Votre nouveau mot de passe est : '.$newPassword
        ];

        Mail::to($email)->send(new ResetPasswordMail($details));

        UsersController::changePassword($request);

        return response(['message' => 'Mail sent successfully'], 200);

    }
}
