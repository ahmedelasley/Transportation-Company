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
            "Egypt": {
                "Governments": [
                    {
                        "name": "Cairo",
                        "cities": [
                            "Cairo",
                            "Giza",
                            "Helwan",
                            "Shubra El-Kheima",
                            "6th of October City",
                            "10th of Ramadan City"
                        ]
                    },
                    {
                        "name": "Alexandria",
                        "cities": [
                            "Alexandria",
                            "Borg El Arab",
                            "New Borg El Arab City"
                        ]
                    },
                    {
                        "name": "Giza",
                        "cities": [
                            "Giza",
                            "6th of October City",
                            "10th of Ramadan City"
                        ]
                    },
                    {
                        "name": "Suez",
                        "cities": [
                            "Suez",
                            "Ismailia",
                            "Port Said"
                        ]
                    },
                    {
                        "name": "Luxor",
                        "cities": [
                            "Luxor",
                            "Qena",
                            "Sohag"
                        ]
                    },
                    {
                        "name": "Aswan",
                        "cities": [
                            "Aswan",
                            "Asyut",
                            "Beni Suef"
                        ]
                    }
                ]
            }
        }';

        $data = json_decode($data, true);

        foreach ($data['Egypt']['Governments'] as $governmentData) {
            $government = \App\Models\Area::create([
                'name' => $governmentData['name'] . ' Government',
                'description' => ' Government',
                'created_id' => rand(1, 2),
                'updated_id' => rand(1, 2),

            ]);

            foreach ($governmentData['cities'] as $cityName) {
                \App\Models\Area::create([
                    'name' => $cityName . ' City',
                    'description' => ' City',
                    'parent_id' => $government->id,
                    'created_id' => rand(1, 2),
                    'updated_id' => rand(1, 2),

                ]);
            }
        }
    }
}
