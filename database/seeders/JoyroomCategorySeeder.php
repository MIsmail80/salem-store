<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Category\Repositories\CategoryRepository;

class JoyroomCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRepository = app(CategoryRepository::class);

        // Find root category or default to 1
        $rootCategory = \Webkul\Category\Models\Category::where('parent_id', null)->first();
        $rootId = $rootCategory ? $rootCategory->id : 1;

        // Create Main Category 'Joyroom'
        $joyroomMain = $categoryRepository->create([
            'en' => [
                'name' => 'Joyroom',
                'slug' => 'joyroom',
                'description' => 'Joyroom is a global consumer electronics brand that specializes in mobile accessories and smart gadgets.',
            ],
            'ar' => [
                'name' => 'جوي روم',
                'slug' => 'joyroom',
                'description' => 'جوي روم هي علامة تجارية عالمية للإلكترونيات الاستهلاكية متخصصة في ملحقات الهواتف المحمولة والأدوات الذكية.',
            ],
            'status' => 1,
            'position' => 6, // After the 5 existing root categories
            'display_mode' => 'products_and_description',
            'parent_id' => $rootId,
        ]);

        $subCategories = [
            [
                'en_name' => 'Charging Solutions',
                'ar_name' => 'حلول الشحن',
                'slug' => 'joyroom-charging',
                'en_desc' => 'Power Banks, Chargers, and Adapters',
                'ar_desc' => 'بنوك الطاقة، أجهزة الشحن، والمحولات',
            ],
            [
                'en_name' => 'Charging Cables',
                'ar_name' => 'كابلات الشحن',
                'slug' => 'joyroom-cables',
                'en_desc' => 'USB-C, Lightning, and Micro-USB cables',
                'ar_desc' => 'كابلات USB-C، لايتنينج، و Micro-USB',
            ],
            [
                'en_name' => 'Wireless Chargers',
                'ar_name' => 'شواحن لاسلكية',
                'slug' => 'joyroom-wireless-chargers',
                'en_desc' => 'Magnetic and pad-style wireless charging solutions',
                'ar_desc' => 'حلول الشحن اللاسلكي المغناطيسية والمسطحة',
            ],
            [
                'en_name' => 'Audio Products',
                'ar_name' => 'المنتجات الصوتية',
                'slug' => 'joyroom-audio',
                'en_desc' => 'TWS earbuds, headphones, and wired earphones',
                'ar_desc' => 'سماعات الأذن اللاسلكية، سماعات الرأس، والسماعات السلكية',
            ],
            [
                'en_name' => 'Phone Mounts & Holders',
                'ar_name' => 'حوامل ومثبتات الهواتف',
                'slug' => 'joyroom-mounts',
                'en_desc' => 'Car mounts, dashboard, and air vent holders',
                'ar_desc' => 'حوامل السيارات، مثبتات لوحة القيادة، وفتحات التهوية',
            ],
            [
                'en_name' => 'Wearable Technology',
                'ar_name' => 'الأجهزة القابلة للارتداء',
                'slug' => 'joyroom-wearables',
                'en_desc' => 'Smartwatches with health tracking',
                'ar_desc' => 'ساعات ذكية مع تتبع الصحة',
            ],
            [
                'en_name' => 'Protective Accessories',
                'ar_name' => 'ملحقات الحماية',
                'slug' => 'joyroom-protection',
                'en_desc' => 'Phone cases and tempered glass screen protectors',
                'ar_desc' => 'أغطية الهواتف وواقيات الشاشة الزجاجية',
            ],
            [
                'en_name' => 'Functional Accessories',
                'ar_name' => 'ملحقات عملية',
                'slug' => 'joyroom-functional',
                'en_desc' => 'Stylus pens, cable management, and adapters',
                'ar_desc' => 'أقلام اللمس، منظمات الكابلات، والمحولات',
            ]
        ];

        foreach ($subCategories as $index => $subData) {
            $categoryRepository->create([
                'en' => [
                    'name' => $subData['en_name'],
                    'slug' => $subData['slug'],
                    'description' => $subData['en_desc'],
                ],
                'ar' => [
                    'name' => $subData['ar_name'],
                    'slug' => $subData['slug'],
                    'description' => $subData['ar_desc'],
                ],
                'status' => 1,
                'position' => $index + 1,
                'display_mode' => 'products_and_description',
                'parent_id' => $joyroomMain->id,
            ]);
        }
    }
}
