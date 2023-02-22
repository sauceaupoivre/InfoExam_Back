<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');
        $formations = ["BTS SIO","BTS SAM","BTS CG","BAC S","BAC ES"];

        for ($i = 0; $i < 5; $i++){
            DB::table('formations')->insert([
                'nom' => $formations[array_rand($formations,1)],
                'serie' => strval($faker->year($max = 'now')),
                'academie' => $faker->city(),


            ]);
        }
    }
}
