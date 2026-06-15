<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Category\Repositories\CategoryRepository;

class AnkerCategorySeeder extends Seeder
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

        // Create Main Category 'Anker'
        $ankerMain = $categoryRepository->create([
            'en' => [
                'name' => 'Anker',
                'slug' => 'anker',
                'description' => 'Anker Innovations products including charging solutions, audio, and smart home devices.',
            ],
            'ar' => [
                'name' => 'أنكر',
                'slug' => 'anker',
                'description' => 'منتجات أنكر للإبداع بما في ذلك حلول الشحن، الصوتيات، وأجهزة المنزل الذكي.',
            ],
            'status' => 1,
            'position' => 5, // After the 4 existing root categories
            'display_mode' => 'products_and_description',
            'parent_id' => $rootId,
        ]);

        $subCategories = [
            [
                'en_name' => 'Charging Solutions',
                'ar_name' => 'حلول الشحن',
                'slug' => 'anker-charging',
                'en_desc' => 'Wall Chargers, Power Banks, Car Chargers, and Cables',
                'ar_desc' => 'شواحن الحائط، بنوك الطاقة، شواحن السيارات، والكابلات',
            ],
            [
                'en_name' => 'Power Stations',
                'ar_name' => 'محطات الطاقة',
                'slug' => 'anker-power-stations',
                'en_desc' => 'Portable Power Stations and Solar Batteries',
                'ar_desc' => 'محطات الطاقة المحمولة وبطاريات الطاقة الشمسية',
            ],
            [
                'en_name' => 'Audio (Soundcore)',
                'ar_name' => 'الصوتيات (ساوند كور)',
                'slug' => 'anker-audio',
                'en_desc' => 'Wireless earbuds, headphones, and portable speakers',
                'ar_desc' => 'سماعات الأذن اللاسلكية، سماعات الرأس، والسماعات المحمولة',
            ],
            [
                'en_name' => 'Smart Home (Eufy)',
                'ar_name' => 'المنزل الذكي (يوفي)',
                'slug' => 'anker-smart-home',
                'en_desc' => 'Smart security cameras, video doorbells, and appliances',
                'ar_desc' => 'كاميرات المراقبة الذكية، أجراس الفيديو، والأجهزة المنزلية',
            ],
            [
                'en_name' => 'Connectivity',
                'ar_name' => 'الاتصال والملحقات',
                'slug' => 'anker-connectivity',
                'en_desc' => 'Data hubs and laptop docking stations',
                'ar_desc' => 'موزعات البيانات ومحطات إرساء الحواسيب المحمولة',
            ],
            [
                'en_name' => 'Projectors (Nebula)',
                'ar_name' => 'أجهزة العرض (نيبولا)',
                'slug' => 'anker-nebula',
                'en_desc' => 'Smart portable projectors and laser home theater displays',
                'ar_desc' => 'أجهزة عرض ذكية محمولة وشاشات مسرح منزلي بالليزر',
            ],
            [
                'en_name' => '3D Printers (AnkerMake)',
                'ar_name' => 'طابعات ثلاثية الأبعاد (أنكر ميك)',
                'slug' => 'anker-3d-printers',
                'en_desc' => 'High-speed and precise 3D printing tools',
                'ar_desc' => 'أدوات طباعة ثلاثية الأبعاد عالية السرعة والدقة',
            ],
            [
                'en_name' => 'Smart Cleaning',
                'ar_name' => 'التنظيف الذكي',
                'slug' => 'anker-smart-cleaning',
                'en_desc' => 'Robotic vacuum cleaners and smart home appliances',
                'ar_desc' => 'المكانس الكهربائية الروبوتية والأجهزة المنزلية الذكية',
            ],
            [
                'en_name' => 'Energy Storage (SOLIX)',
                'ar_name' => 'تخزين الطاقة (سوليكس)',
                'slug' => 'anker-solix',
                'en_desc' => 'Home battery backup systems and solar panels',
                'ar_desc' => 'أنظمة النسخ الاحتياطي لبطاريات المنزل والألواح الشمسية',
            ],
            [
                'en_name' => 'Personal Health',
                'ar_name' => 'الصحة الشخصية',
                'slug' => 'anker-personal-health',
                'en_desc' => 'Smart scales and personal wellness devices',
                'ar_desc' => 'موازين ذكية وأجهزة العافية الشخصية',
            ],
            [
                'en_name' => 'Gaming Accessories',
                'ar_name' => 'ملحقات الألعاب',
                'slug' => 'anker-gaming',
                'en_desc' => 'VR accessories and gaming headsets',
                'ar_desc' => 'ملحقات الواقع الافتراضي وسماعات الألعاب',
            ],
            [
                'en_name' => 'Work From Home Essentials',
                'ar_name' => 'أساسيات العمل من المنزل',
                'slug' => 'anker-wfh',
                'en_desc' => 'Webcams, speakerphones, and docking stations for productivity',
                'ar_desc' => 'كاميرات ويب، ومكبرات صوت، ومحطات إرساء لزيادة الإنتاجية',
            ],
            [
                'en_name' => 'Travel Gear',
                'ar_name' => 'معدات السفر',
                'slug' => 'anker-travel',
                'en_desc' => 'Compact chargers and portable power for travelers',
                'ar_desc' => 'شواحن مدمجة وطاقة محمولة للمسافرين',
            ],
            [
                'en_name' => 'Security Systems',
                'ar_name' => 'أنظمة الأمان',
                'slug' => 'anker-security',
                'en_desc' => 'Smart locks, alarm systems, and outdoor security',
                'ar_desc' => 'أقفال ذكية، أنظمة إنذار، وأمان خارجي',
            ],
            [
                'en_name' => 'Pet Care (Eufy Pet)',
                'ar_name' => 'رعاية الحيوانات الأليفة',
                'slug' => 'anker-pet-care',
                'en_desc' => 'Pet cameras, water fountains, and automated care devices',
                'ar_desc' => 'كاميرات مراقبة، نوافير مياه، وأجهزة رعاية آلية للحيوانات الأليفة',
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
                'parent_id' => $ankerMain->id,
            ]);
        }

        // Create 10 New Root Categories so total Root children = 15 (4 existing + Anker + 10 new)
        $newRootCategories = [
            ['en' => 'Smart TVs', 'ar' => 'الشاشات الذكية', 'slug' => 'smart-tvs'],
            ['en' => 'Wearables', 'ar' => 'الأجهزة القابلة للارتداء', 'slug' => 'wearables'],
            ['en' => 'Tablets', 'ar' => 'الأجهزة اللوحية', 'slug' => 'tablets'],
            ['en' => 'Cameras', 'ar' => 'الكاميرات', 'slug' => 'cameras'],
            ['en' => 'Gaming Consoles', 'ar' => 'أجهزة الألعاب', 'slug' => 'gaming-consoles'],
            ['en' => 'Home Appliances', 'ar' => 'الأجهزة المنزلية', 'slug' => 'home-appliances'],
            ['en' => 'Networking', 'ar' => 'أجهزة الشبكات', 'slug' => 'networking'],
            ['en' => 'Software', 'ar' => 'البرمجيات', 'slug' => 'software'],
            ['en' => 'Office Supplies', 'ar' => 'اللوازم المكتبية', 'slug' => 'office-supplies'],
            ['en' => 'Electric Scooters', 'ar' => 'سكوتر كهربائي', 'slug' => 'electric-scooters'],
        ];

        foreach ($newRootCategories as $index => $catData) {
            $categoryRepository->create([
                'en' => [
                    'name' => $catData['en'],
                    'slug' => $catData['slug'],
                    'description' => $catData['en'] . ' Category',
                ],
                'ar' => [
                    'name' => $catData['ar'],
                    'slug' => $catData['slug'],
                    'description' => 'فئة ' . $catData['ar'],
                ],
                'status' => 1,
                'position' => 6 + $index,
                'display_mode' => 'products_and_description',
                'parent_id' => $rootId,
            ]);
        }
    }
}
