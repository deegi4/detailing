<?php

use Illuminate\Database\Seeder;

class CarClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('car_classes')->insert([
            'name' => 'лег.'
        ]);
        DB::table('car_classes')->insert([
            'name' => 'ср.'
        ]);
        DB::table('car_classes')->insert([
            'name' => 'бол.'
        ]);

    }
}
