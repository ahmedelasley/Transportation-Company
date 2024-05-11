<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = '{
            "Statuses": {
                "MainCategories": [
                    {
                        "name": "Public",
                        "subCategories": [
                            "Active",
                            "Inactive"
                        ]
                    },
                    {
                        "name": "Trips",
                        "subCategories": [
                            "Completed"
                        ]
                    }
                ]
            }
        }';

        $data = json_decode($data, true);

        foreach ($data['Statuses']['MainCategories'] as $mainCategory) {
            $category = \App\Models\Status::create([
                'name' => $mainCategory['name'],
                'description' => ' Main Category',
                'created_id' => rand(1, 2),
                'updated_id' => rand(1, 2),

            ]);

            foreach ($mainCategory['subCategories'] as $subCat) {
                \App\Models\Status::create([
                    'name' => $subCat,
                    'description' => 'Sub Category',
                    'parent_id' => $category->id,
                    'created_id' => rand(1, 2),
                    'updated_id' => rand(1, 2),

                ]);
            }
        }
    }
}
