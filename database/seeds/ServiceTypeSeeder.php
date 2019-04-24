<?php

use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('service_types')->insert([
            'name' => 'Мойка'
        ]);
        DB::table('service_types')->insert([
            'name' => 'Химчистка автомобиля'
        ]);
        DB::table('service_types')->insert([
            'name' => 'Полировка'
        ]);
        DB::table('service_types')->insert([
            'name' => 'Нанесение составов'
        ]);
    }
}
