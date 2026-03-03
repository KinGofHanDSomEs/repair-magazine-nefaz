<?php

namespace Database\Seeders;

use App\Models\Technic;
use Illuminate\Database\Seeder;

class TechnicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technics = [
            ['name' => 'Вахтовые автобусы', 'image_url' => 'images/technics/shift-bus.webp'],
            ['name' => 'Автобусы и электробусы', 'image_url' => 'images/technics/bus.webp'],
            ['name' => 'Грузопасажирские автомобили', 'image_url' => 'images/technics/passenger-car.webp'],
            ['name' => 'Автоцистерны', 'image_url' => 'images/technics/tanker-truck.webp'],
            ['name' => 'Самосвалы',  'image_url' => 'images/technics/dump-truck.webp'],
            ['name' => 'Полуприцепы', 'image_url' => 'images/technics/semi-trailer.webp'],
            ['name' => 'Самосвальные прицепы',  'image_url' => 'images/technics/dump-truck-trailer.webp'],
            ['name' => 'Сельхозтехника', 'image_url' => 'images/technics/agricultural-machinery.webp'],
        ];

        foreach ($technics as $technic) {
            Technic::create($technic);
        }
    }
}
