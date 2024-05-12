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
                        "name": "السيارات",
                        "subCategories": [
                            "قلاب",
                            "سطحة",
                            "ستارة",
                            "جوانب"
                        ]
                    }
                ]
            }
        }';

        $data = json_decode($data, true);

        foreach ($data['Categories']['MainCategories'] as $mainCategory) {
            $category = \App\Models\Category::create([
                'name' => $mainCategory['name'],
                'description' => NULL,
                'created_id' => 1,
                // 'updated_id' => rand(1, 2),

            ]);

            foreach ($mainCategory['subCategories'] as $subCat) {
                \App\Models\Category::create([
                    'name' => $subCat,
                    'description' => NULL,
                    'parent_id' => $category->id,
                    'created_id' => 1,
                    // 'updated_id' => rand(1, 2),

                ]);
            }
        }
    }
}
