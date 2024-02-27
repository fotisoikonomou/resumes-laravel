<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DegreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $degrees = [
            ['degreeTitle' => 'High School'],
            ['degreeTitle' => 'BSc'],
            ['degreeTitle' => 'MSc'],
        ];
    
        foreach ($degrees as $degree) {
            DB::table('degrees')->insert($degree);
        }
    }
}
