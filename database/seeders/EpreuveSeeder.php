<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker;

class EpreuveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++ ){
            DB::table('epreuves')->insert([
                'examen_concours' => Str::random(4),
                'epreuve' => Str::random(4),
                'session' => strval($faker->year($max = 'now')),
                'matiere' => Str::random(4),
                'description' => $faker->text($maxNbChars = 60),
                'debut' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
                'fin' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
                'loge' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),

            ]);
        }
    }
}
