<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = '{
            "SaudiArabia": {
              "cities": [
                {
                  "name": "الرياض"
                },
                {
                  "name": "جدة"
                },
                {
                  "name": "مكة المكرمة"
                },
                {
                  "name": "المدينة المنورة"
                },
                {
                  "name": "الدمام"
                },
                {
                  "name": "بريدة"
                },
                {
                  "name": "تبوك"
                },
                {
                  "name": "خميس مشيط"
                },
                {
                  "name": "حائل"
                },
                {
                  "name": "الطائف"
                }
              ]
            }
          }';

        $data = json_decode($data, true);

        foreach ($data['SaudiArabia']['cities'] as $governmentData) {
            $government = \App\Models\Area::create([
                'name' => $governmentData['name'],
                'description' => NULL,
                'created_id' => 1,
                // 'updated_id' => rand(1, 2),

            ]);

            // foreach ($governmentData['cities'] as $cityName) {
            //     \App\Models\Area::create([
            //         'name' => $cityName . ' City',
            //         'description' => ' City',
            //         'parent_id' => $government->id,
            //         'created_id' => rand(1, 2),
            //         'updated_id' => rand(1, 2),

            //     ]);
            // }
        }
    }
}
