<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = '{
            "Questions": {
                "MainCategories": [
                    {
                        "name": "Are you satasfied ?",
                        "category_id": 15,
                        "status_id": 1
                    },
                    {
                        "name": "Will recommend service to friend ?",
                        "category_id": 16,
                        "status_id": 1
                    },
                    {
                        "name": "How rate car cleaning",
                        "category_id": 15,
                        "status_id": 1
                    },
                    {
                        "name": "How rate chaufer",
                        "category_id": 16,
                        "status_id": 1
                    },
                    {
                        "name": "Did the car arrive on time",
                        "category_id": 16,
                        "status_id": 1
                    },
                    {
                        "name": "How evaluate the car ?",
                        "category_id": 15,
                        "status_id": 1
                    },
                    {
                        "name": "How evaluate the chair?",
                        "category_id": 15,
                        "status_id": 1
                    },
                    {
                        "name": "How evaluate the driver?",
                        "category_id": 15,
                        "status_id": 1
                    },
                    {
                        "name": "How evaluate the transporting?",
                        "category_id": 15,
                        "status_id": 1
                    },
                    {
                        "name": "Will repeate the service?",
                        "category_id": 16,
                        "status_id": 1
                    },
                    {
                        "name": "Are you save the number ?",
                        "category_id": 16,
                        "status_id": 1
                    }
                ]
            }
        }';

        $data = json_decode($data, true);

        foreach ($data['Questions']['MainCategories'] as $mainCategory) {
            $category = \App\Models\Question::create([
                'name' => $mainCategory['name'],
                'category_id' => $mainCategory['category_id'],
                'status_id' => $mainCategory['status_id'],
                'created_id' => rand(1, 2),
                'updated_id' => rand(1, 2),
            ]);

        }
    }
}
