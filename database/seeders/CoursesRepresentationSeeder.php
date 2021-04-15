<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesRepresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        //Ajout des thèmes
        DB::table('themes')->insert([
            'id' => 1,
            'name' => 'Lis une partition',
            'associated_year' => 1,
        ]);
        DB::table('themes')->insert([
            'id' => 2,
            'name' => 'Apprends à lire les notes',
            'associated_year' => 1,
        ]);
        DB::table('themes')->insert([
            'id' => 3,
            'name' => 'Améliore ton rythme',
            'associated_year' => 1,
        ]);
        DB::table('themes')->insert([
            'id' => 4,
            'name' => 'Ecoute les instruments',
            'associated_year' => 1,
        ]);

        //Ajout des chapitres
        DB::table('chapters')->insert([
            'id' => 1,
            'name' => 'Structure d\'une portée',
            'theme_id' => 1,
        ]);
        DB::table('chapters')->insert([
            'id' => 2,
            'name' => 'Les nuances',
            'theme_id' => 1,
        ]);
        DB::table('chapters')->insert([
            'id' => 3,
            'name' => 'Lecture de notes',
            'theme_id' => 2,
        ]);
        DB::table('chapters')->insert([
            'id' => 4,
            'name' => 'Améliore ton rythme',
            'theme_id' => 3,
        ]);
        DB::table('chapters')->insert([
            'id' => 5,
            'name' => 'Les familles d\'instruments',
            'theme_id' => 4,
        ]);

        //Ajout des Mini-jeux/quiz
        DB::table('minigames_quizzes')->insert([
            'id' => 1,
            'name' => 'Structure d\'une portée - entrainement',
            'chapter_id' => 1,
            'nbr_trainings' => 1,
        ]);
        DB::table('minigames_quizzes')->insert([
            'id' => 2,
            'name' => 'Structure d\'une portée - quiz',
            'chapter_id' => 1,
        ]);
        DB::table('minigames_quizzes')->insert([
            'id' => 3,
            'name' => 'Les nuances - entrainement',
            'chapter_id' => 2,
            'nbr_trainings' => 1,
        ]);
        DB::table('minigames_quizzes')->insert([
            'id' => 4,
            'name' => 'Les nuances - quiz',
            'chapter_id' => 2,
        ]);
        DB::table('minigames_quizzes')->insert([
            'id' => 5,
            'name' => 'Lis une partition - quiz final',
            'chapter_id' => 2,
        ]);
        DB::table('minigames_quizzes')->insert([
            'id' =>6,
            'name' => 'Lecture de notes - entrainement',
            'chapter_id' => 3,
            'nbr_trainings' => 6,
        ]);
        DB::table('minigames_quizzes')->insert([
            'id' =>7,
            'name' => 'Lecture de notes - quiz',
            'chapter_id' => 3,
        ]);
        DB::table('minigames_quizzes')->insert([
            'id' => 8,
            'name' => 'Améliore ton rythme - entrainement',
            'chapter_id' => 4,
            'nbr_trainings' => 3,
        ]);
        DB::table('minigames_quizzes')->insert([
            'id' => 9,
            'name' => 'Améliore ton rythme - quiz',
            'chapter_id' => 4,
        ]);
        DB::table('minigames_quizzes')->insert([
            'id' => 10,
            'name' => 'Ecoute les instruments - entrainement',
            'chapter_id' => 5,
            'nbr_trainings' => 14,
        ]);
    }
}
