<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = '{
            "Categories": {
                "MainCategories": [
                    {
                        "name": "Clients",
                        "subCategories": [
                            "Client",
                            "Interested",
                            "Twarea",
                            "Issaf"
                        ]
                    },
                    {
                        "name": "Trips",
                        "subCategories": [
                            "Transport"
                        ]
                    },
                    {
                        "name": "Vehicles",
                        "subCategories": [
                            "Public"
                        ]
                    },
                    {
                        "name": "Phones",
                        "subCategories": [
                            "Personel"
                        ]
                    },
                    {
                        "name": "Companies",
                        "subCategories": [
                            "Public"
                        ]
                    },
                    {
                        "name": "Questions",
                        "subCategories": [
                            "Rating",
                            "True or False"
                        ]
                    },
                    {
                        "name": "Socails",
                        "subCategories": [
                            "Public"
                        ]
                    }
                ]
            }
        }';

        $data = json_decode($data, true);

        foreach ($data['Categories']['MainCategories'] as $mainCategory) {
            $category = \App\Models\Category::create([
                'name' => $mainCategory['name'],
                'description' => ' Main Category',
                'created_id' => rand(1, 2),
                'updated_id' => rand(1, 2),

            ]);

            foreach ($mainCategory['subCategories'] as $subCat) {
                \App\Models\Category::create([
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
