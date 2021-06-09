<?php

namespace App\Http\Controllers;

use App\Models\AchievementChapters;
use App\Models\AchievementMGQ;
use App\Models\MiniGameQuiz;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function getFullProfile(Request $request){

        if(isset($request['user_id'])){
            $userId = $request['user_id'];
        }
        else $userId = $request->user()->id;
        $user = User::where('id', $userId)->first();
        $progression = [];
        $chapter = [];

        $eleve = [
            'id' => $user->id,
            'nom' => $user->lastname,
            'prenom' => $user->name,
            'type' => $user->type,
            ];

        //On récupère les résultats pour le cours sur les notes
        $entrainement = [];
        for ($i = 1; $i<=DB::table('minigames_quizzes')->where('id', 6)->first()->nbr_trainings; $i++){
            $score = DB::table('achievement_m_g_q_s')
                ->where('user_id', $userId)
                ->where('MGQ_id', 6)
                ->where('level', $i)
                ->where('evaluated', 1)
                ->first();
            array_push($entrainement, $score !== null);
        }
        $quizQuery = DB::table('achievement_m_g_q_s')
            ->where('user_id', $userId)
            ->where('MGQ_id', 7)
            ->where('evaluated', 1)
            ->first();
        $quiz = $quizQuery!== null;

        $note = ["entrainement" => $entrainement,
            "quiz" => $quiz,
        ];
        $chapter["note"] = $note;
        //FIN

        //On récupère les résultats pour le cours sur le rythme
        $entrainement = [];
        for ($i = 1; $i<=DB::table('minigames_quizzes')->where('id', 8)->first()->nbr_trainings; $i++){
            $score = DB::table('achievement_m_g_q_s')
                ->where('user_id', $userId)
                ->where('MGQ_id', 8)
                ->where('evaluated', 1)
                ->where('level', $i)
                ->first();
            array_push($entrainement, $score !== null);
        }
        $quizQuery = DB::table('achievement_m_g_q_s')
            ->where('user_id', $userId)
            ->where('MGQ_id', 9)
            ->where('evaluated', 1)
            ->first();
        $quiz = $quizQuery!== null;

        $rythme = ["entrainement" => $entrainement,
            "quiz" => $quiz,
        ];
        $chapter["rythme"] = $rythme;
        //FIN

        //On récupère les résultats pour le cours sur les partitions
        //Partie nuances
        $entrainement = [];
        for ($i = 1; $i<=DB::table('minigames_quizzes')->where('id', 3)->first()->nbr_trainings; $i++){
            $score = DB::table('achievement_m_g_q_s')
                ->where('user_id', $userId)
                ->where('MGQ_id', 3)
                ->where('evaluated', 1)
                ->where('level', $i)
                ->first();
            array_push($entrainement, $score !== null);
        }
        $quizQuery = DB::table('achievement_m_g_q_s')
            ->where('user_id', $userId)
            ->where('evaluated', 1)
            ->where('MGQ_id', 4)
            ->first();
        $quiz = $quizQuery!== null;

        $nuance = ["entrainement" => $entrainement,
            "quiz" => $quiz,
        ];
        //Partie structure
        $entrainement = [];
        for ($i = 1; $i<=DB::table('minigames_quizzes')->where('id', 1)->first()->nbr_trainings; $i++){
            $score = DB::table('achievement_m_g_q_s')
                ->where('user_id', $userId)
                ->where('MGQ_id', 1)
                ->where('evaluated', 1)
                ->where('level', $i)
                ->first();
            array_push($entrainement, $score !== null);
        }
        $quizQuery = DB::table('achievement_m_g_q_s')
            ->where('user_id', $userId)
            ->where('MGQ_id', 2)
            ->where('evaluated', 1)
            ->first();
        $quiz = $quizQuery!== null;

        $structure = ["entrainement" => $entrainement,
            "quiz" => $quiz,
        ];
        //Quiz Final
        $quizQuery = DB::table('achievement_m_g_q_s')
            ->where('user_id', $userId)
            ->where('MGQ_id', 5)
            ->first();
        $quiz = $quizQuery!== null;
        $partition = [
            "nuance" => $nuance,
            "structure" => $structure,
            "quiz" => $quiz
        ];
        $chapter["partition"] = $partition;

        //On récupère les résultats pour le cours sur les partitions
        $entrainement = [];
        for ($i = 1; $i<=DB::table('minigames_quizzes')->where('id', 10)->first()->nbr_trainings; $i++){
            $score = DB::table('achievement_m_g_q_s')
                ->where('user_id', $userId)
                ->where('MGQ_id', 10)
                ->where('evaluated', 1)
                ->where('level', $i)
                ->first();
            array_push($entrainement, $score !== null);
        }
        $instrument = ["entrainement" => $entrainement];
        $chapter["instrument"] = $instrument;

        $progression["chapter"] = $chapter;
        $eleve["progression"] = $progression;
        return response($eleve, 200);
    }

    public static function changePassword(Request $request){

        if(!isset($request['email'])){
            $user = User::where('id', $request->user()->id)->update(['password' => Hash::make($request['new_password'])]);
            return response(['message' => 'Password changed successfully']);
        }

        $user = User::where('email', $request['email'])->update(['password' => Hash::make($request['new_password'])]);
        return response(['message' => 'Password changed successfully']);
    }

    public static function deleteUser(Request $request){
        AchievementChapters::where('user_id', $request['user_id'])->delete();
        AchievementMGQ::where('user_id', $request['user_id'])->delete();
        User::where('id', $request['user_id'])->delete();
        return response(['message' => 'User deleted']);
    }

}
