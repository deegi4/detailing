<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('services')->insert([
            'name' => 'Детейлинг мойка автомобиля (кузов, пороги, пылесос, протирка салона спец. средствами)',
            'service_type_id' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Стандартная мойка (кузов, коврики, пластик, стёкла)',
            'service_type_id' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Мойка и защита моторного отсека',
            'service_type_id' => 1,
        ]);
        DB::table('services')->insert([
            'name' => 'Комплексная мойка (кузов, коврики, пластик, стёкла, пылесос, чернение резины)',
            'service_type_id' => 1,
        ]);

        DB::table('services')->insert([
            'name' => 'Детейлинг химчистка автомобиля(полностью салон)',
            'service_type_id' => 2,
        ]);
        DB::table('services')->insert([
            'name' => 'Деликатная чистка сидений',
            'service_type_id' => 2,
        ]);
        DB::table('services')->insert([
            'name' => 'Химчистка 1 сидения',
            'service_type_id' => 2,
        ]);
        DB::table('services')->insert([
            'name' => 'Химчистка багажного отделения',
            'service_type_id' => 2,
        ]);
        DB::table('services')->insert([
            'name' => 'Обработка пластика',
            'service_type_id' => 2,
        ]);

        DB::table('services')->insert([
            'name' => 'Полировка фар',
            'service_type_id' => 3,
        ]);
        DB::table('services')->insert([
            'name' => 'Полировка дисков',
            'service_type_id' => 3,
        ]);
        DB::table('services')->insert([
            'name' => 'Полировка 1 стекла',
            'service_type_id' => 3,
        ]);

        DB::table('services')->insert([
            'name' => 'Нанесение Ceramic Pro (для кожи салона)',
            'service_type_id' => 4,
        ]);
        DB::table('services')->insert([
            'name' => 'Нанесение Ceramic Pro (для кузова автомобиля)',
            'service_type_id' => 4,
        ]);
        DB::table('services')->insert([
            'name' => 'Нанесение состава "Анти дождь"',
            'service_type_id' => 4,
        ]);
    }
}
