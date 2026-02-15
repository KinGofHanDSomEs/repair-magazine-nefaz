<?php

namespace Database\Seeders;

use App\Models\Technic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technics = [
            ['name' => 'Автоцистерны'],

            ['name' => 'Вахтовые автобусы', 'model' => '4208', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '4208-14-42', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '4208-16-42', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '42111-14-45', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '4208-17-42', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '42111-16-45', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '42111-12-45', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '42111-15-45', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '4208-15-42', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '4208-18-42', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '42111М (c полками)', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '4208-10-41', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '42111М', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '4208М', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Вахтовые автобусы', 'model' => '4208-34', 'image_url' => 'assets/images/technics//.jpg'],

            ['name' => 'Полуприцепы-цистерны', 'model' => '96743-01', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96741-30', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96742-20-03', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96891', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96742-06', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96931-02', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '9638', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96744', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96745', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '9638-01', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96742-04', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '9693', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96742-03', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96741', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '96742', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Полуприцепы-цистерны', 'model' => '9693-02', 'image_url' => 'assets/images/technics//.jpg'],

            ['name' => 'Прицепы-цистерны', 'model' => '8602-04', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Прицепы-цистерны', 'model' => '8602-03', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Прицепы-цистерны', 'model' => '8602', 'image_url' => 'assets/images/technics//.jpg'],

            ['name' => 'Самосвалы', 'model' => '6520', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '6540', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '6520', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '53605', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '6520', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '65201', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '6522', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '45144', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '43255', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '65111', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '6520', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '45144', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => 'Actros 3336 K', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '65201 «Люкс»', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '6520', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвалы', 'model' => '65222', 'image_url' => 'assets/images/technics//.jpg'],

            ['name' => 'Самосвальные полуприцепы', 'model' => '9509-17-30', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвальные полуприцепы', 'model' => '9509-32-30', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвальные полуприцепы', 'model' => '9509-30', 'image_url' => 'assets/images/technics//.jpg'],

            ['name' => 'Самосвальные прицепы', 'model' => '8560-05', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвальные прицепы', 'model' => '8560-03', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвальные прицепы', 'model' => '8560-02', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвальные прицепы', 'model' => '8560-04', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвальные прицепы', 'model' => '8560-06', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Самосвальные прицепы', 'model' => '8560-02', 'image_url' => 'assets/images/technics//.jpg'],

            ['name' => 'Сельхозтехника', 'model' => '6385-41', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Сельхозтехника', 'model' => '6520-72-60', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Сельхозтехника', 'model' => '45144-30-04', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Сельхозтехника', 'model' => '45144-32-04', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Сельхозтехника', 'model' => '65117-PF', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Сельхозтехника', 'model' => '45143-12-05', 'image_url' => 'assets/images/technics//.jpg'],
            ['name' => 'Сельхозтехника', 'model' => '65207-01-S5', 'image_url' => 'assets/images/technics//.jpg'],

            ['name' => 'Автотехника по спеццене'],
        ];

        foreach ($technics as $technic) {
            Technic::create($technic);
        }
    }
}
