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
            'name' => 'Легковые'
        ]);
        DB::table('car_classes')->insert([
            'name' => 'Средние'
        ]);
        DB::table('car_classes')->insert([
            'name' => 'Большие'
        ]);

    }
}
