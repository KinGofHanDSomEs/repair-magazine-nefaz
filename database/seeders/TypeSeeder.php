<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Technic;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                ['model' => '4208-17-42'],
                ['model' => '42111-14-45'],
                ['model' => 'НЕФАЗ - 4208-0000016-42'],
                ['model' => '4208-14-42'],
            ],
            [
                ['model' => 'НЕФАЗ-5299-201'],
                ['model' => 'НЕФАЗ-5299-30'],
            ],
            [
                ['model' => 'НЕФАЗ-4208'],
            ],
            [
                ['model' => 'НЕФАЗ-6602'],
                ['model' => 'НЕФАЗ-6602-01'],
            ],
            [
                ['model' => 'НЕФАЗ-65117'],
                ['model' => 'НЕФАЗ-6520'],
            ],
            [
                ['model' => 'НЕФАЗ-9334'],
                ['model' => 'НЕФАЗ-9334-01'],
            ],
            [
                ['model' => 'НЕФАЗ-8332'],
            ],
            [
                ['model' => 'НЕФАЗ-8901'],
            ]
        ];

        foreach (Technic::all() as $i => $technic) {
            foreach ($types[$i] as $type) {
                Type::create([
                    'technic_id' => $technic->id,
                    ...$type,
                ]);
            }
        }
    }
}
