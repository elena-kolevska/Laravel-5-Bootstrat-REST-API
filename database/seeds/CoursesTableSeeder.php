<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        //Seed courses table
        for($i=1; $i < 20; $i++ ){
             $data = [
                     ['name' => 'Capoeira'],
                     ['name' => 'Samba'],
                     ['name' => 'Forro'],
                     ['name' => 'Jiu Jitsu'],
                 ];
        }
        DB::table('courses')->insert($data);


        //Seed the course_user pivot table
        for($i=1; $i < 20; $i++ ){
             $data = ['course_id' => $faker->numberBetween(1,4), 'user_id'=>$i];
            DB::table('course_user')->insert($data);
        }


    }

}