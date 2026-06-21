<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webkul\Category\Models\CategoryTranslation;
use Carbon\Carbon;

class JoyroomThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Get the Joyroom Category ID
        $joyroomCategory = CategoryTranslation::where('name', 'Joyroom')->first();
        if (!$joyroomCategory) {
            $this->command->error('Joyroom category not found. Please run JoyroomCategorySeeder first.');
            return;
        }

        $categoryId = $joyroomCategory->category_id;

        // 2. Insert into theme_customizations
        $now = Carbon::now();
        $tcId = DB::table('theme_customizations')->insertGetId([
            'theme_code' => 'default',
            'type'       => 'brand_showcase',
            'name'       => 'Brand Showcase',
            'sort_order' => 6,
            'status'     => 1,
            'channel_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 3. Insert into theme_customization_translations
        $options = json_encode([
            'filters' => [
                'sort' => 'asc',
                'limit' => '10',
                'parent_id' => (string) $categoryId,
            ],
            'brand_name' => 'عائلة', // "Family"
            'brand_color' => '#1e1e1e', // Sleek dark color for Joyroom
            'brand_subtitle' => 'Joyroom',
        ]);

        $locales = ['en', 'ar'];

        foreach ($locales as $locale) {
            DB::table('theme_customization_translations')->insert([
                'theme_customization_id' => $tcId,
                'locale'                 => $locale,
                'options'                => $options,
            ]);
        }

        $this->command->info('Joyroom brand showcase theme customization added successfully.');
    }
}
