<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        for ($i=0; $i<100; $i++) {
            DB::table('students')-> insert([
            'name' =>  $faker->name(),
            'age' =>  $faker->numberBetween(18, 99),
            'city' =>  $faker->city(),
            // 'created_at' =>  \Carbon\Carbon::now(),
            // 'updated_at' =>  \Carbon\Carbon::now(),
            // 'deleted_at' =>  \Carbon\Carbon::now(),
        ]);
        }
    }
} 