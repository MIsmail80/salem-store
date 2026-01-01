<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Electronics Category Seeder for Salem Store.
 *
 * Structure:
 * - Root (الرئيسية)
 *   ├── Mobile Phones (الهواتف المحمولة)
 *   ├── Computers (أجهزة الكمبيوتر)
 *   ├── Laptops (أجهزة اللابتوب)
 *   └── Accessories (اكسسوارات)
 *
 * Command: php artisan db:seed --class=ElectronicsCategorySeeder
 */
class ElectronicsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing data
        DB::table('category_filterable_attributes')->truncate();
        DB::table('category_translations')->truncate();
        DB::table('categories')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ============================
        // CATEGORIES TABLE
        // ============================
        $categories = [
            // Root Category
            ['id' => 1, 'position' => 1, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 1, '_rgt' => 60, 'parent_id' => null],

            // Main Categories (Level 1 - Direct children of Root)
            ['id' => 2, 'position' => 1, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 2, '_rgt' => 15, 'parent_id' => 1],  // Mobile Phones
            ['id' => 9, 'position' => 2, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 16, '_rgt' => 27, 'parent_id' => 1], // Computers
            ['id' => 15, 'position' => 3, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 28, '_rgt' => 41, 'parent_id' => 1], // Laptops
            ['id' => 22, 'position' => 4, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 42, '_rgt' => 59, 'parent_id' => 1], // Accessories

            // Mobile Phones Subcategories (Level 2)
            ['id' => 3, 'position' => 1, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 3, '_rgt' => 4, 'parent_id' => 2],   // Smartphones
            ['id' => 4, 'position' => 2, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 5, '_rgt' => 6, 'parent_id' => 2],   // Feature Phones
            ['id' => 5, 'position' => 3, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 7, '_rgt' => 8, 'parent_id' => 2],   // Phone Cases
            ['id' => 6, 'position' => 4, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 9, '_rgt' => 10, 'parent_id' => 2],  // Screen Protectors
            ['id' => 7, 'position' => 5, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 11, '_rgt' => 12, 'parent_id' => 2], // Chargers & Cables
            ['id' => 8, 'position' => 6, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 13, '_rgt' => 14, 'parent_id' => 2], // Power Banks

            // Computers Subcategories (Level 2)
            ['id' => 10, 'position' => 1, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 17, '_rgt' => 18, 'parent_id' => 9], // Desktop Computers
            ['id' => 11, 'position' => 2, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 19, '_rgt' => 20, 'parent_id' => 9], // All-in-One PCs
            ['id' => 12, 'position' => 3, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 21, '_rgt' => 22, 'parent_id' => 9], // Monitors
            ['id' => 13, 'position' => 4, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 23, '_rgt' => 24, 'parent_id' => 9], // Computer Components
            ['id' => 14, 'position' => 5, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 25, '_rgt' => 26, 'parent_id' => 9], // PC Gaming

            // Laptops Subcategories (Level 2)
            ['id' => 16, 'position' => 1, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 29, '_rgt' => 30, 'parent_id' => 15], // Gaming Laptops
            ['id' => 17, 'position' => 2, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 31, '_rgt' => 32, 'parent_id' => 15], // Business Laptops
            ['id' => 18, 'position' => 3, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 33, '_rgt' => 34, 'parent_id' => 15], // Ultrabooks
            ['id' => 19, 'position' => 4, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 35, '_rgt' => 36, 'parent_id' => 15], // 2-in-1 Laptops
            ['id' => 20, 'position' => 5, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 37, '_rgt' => 38, 'parent_id' => 15], // Chromebooks
            ['id' => 21, 'position' => 6, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 39, '_rgt' => 40, 'parent_id' => 15], // Laptop Bags

            // Accessories Subcategories (Level 2)
            ['id' => 23, 'position' => 1, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 43, '_rgt' => 44, 'parent_id' => 22], // Keyboards
            ['id' => 24, 'position' => 2, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 45, '_rgt' => 46, 'parent_id' => 22], // Mice
            ['id' => 25, 'position' => 3, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 47, '_rgt' => 48, 'parent_id' => 22], // Headphones
            ['id' => 26, 'position' => 4, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 49, '_rgt' => 50, 'parent_id' => 22], // Speakers
            ['id' => 27, 'position' => 5, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 51, '_rgt' => 52, 'parent_id' => 22], // Webcams
            ['id' => 28, 'position' => 6, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 53, '_rgt' => 54, 'parent_id' => 22], // USB Hubs
            ['id' => 29, 'position' => 7, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 55, '_rgt' => 56, 'parent_id' => 22], // External Storage
            ['id' => 30, 'position' => 8, 'status' => 1, 'display_mode' => 'products_and_description', '_lft' => 57, '_rgt' => 58, 'parent_id' => 22], // Cables & Connectors
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert(array_merge($category, [
                'logo_path' => null,
                'banner_path' => null,
                'additional' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        // ============================
        // CATEGORY TRANSLATIONS (Arabic & English)
        // ============================
        $translations = [
            // Root
            ['category_id' => 1, 'locale' => 'ar', 'name' => 'الرئيسية', 'slug' => 'root', 'description' => 'الفئة الرئيسية للمتجر', 'meta_title' => 'متجر سالم', 'meta_description' => 'متجر سالم للإلكترونيات', 'meta_keywords' => 'متجر, إلكترونيات, سالم'],
            ['category_id' => 1, 'locale' => 'en', 'name' => 'Root', 'slug' => 'root', 'description' => 'Root Category', 'meta_title' => 'Salem Store', 'meta_description' => 'Salem Electronics Store', 'meta_keywords' => 'store, electronics, salem'],

            // Mobile Phones
            ['category_id' => 2, 'locale' => 'ar', 'name' => 'الهواتف المحمولة', 'slug' => 'الهواتف-المحمولة', 'description' => 'أحدث الهواتف الذكية والمحمولة من أفضل العلامات التجارية', 'meta_title' => 'الهواتف المحمولة', 'meta_description' => 'تسوق أحدث الهواتف الذكية', 'meta_keywords' => 'هواتف, موبايل, ذكية'],
            ['category_id' => 2, 'locale' => 'en', 'name' => 'Mobile Phones', 'slug' => 'mobile-phones', 'description' => 'Latest smartphones and mobile phones from top brands', 'meta_title' => 'Mobile Phones', 'meta_description' => 'Shop the latest smartphones', 'meta_keywords' => 'phones, mobile, smartphones'],

            // Smartphones
            ['category_id' => 3, 'locale' => 'ar', 'name' => 'الهواتف الذكية', 'slug' => 'الهواتف-الذكية', 'description' => 'هواتف ذكية بأحدث التقنيات والمواصفات', 'meta_title' => 'الهواتف الذكية', 'meta_description' => 'أحدث الهواتف الذكية', 'meta_keywords' => 'هواتف ذكية, سمارت فون'],
            ['category_id' => 3, 'locale' => 'en', 'name' => 'Smartphones', 'slug' => 'smartphones', 'description' => 'Smart phones with latest technology and specifications', 'meta_title' => 'Smartphones', 'meta_description' => 'Latest smartphones', 'meta_keywords' => 'smartphones, smart phones'],

            // Feature Phones
            ['category_id' => 4, 'locale' => 'ar', 'name' => 'الهواتف الأساسية', 'slug' => 'الهواتف-الاساسية', 'description' => 'هواتف أساسية بسيطة وموثوقة', 'meta_title' => 'الهواتف الأساسية', 'meta_description' => 'هواتف أساسية بسيطة', 'meta_keywords' => 'هواتف أساسية, هواتف بسيطة'],
            ['category_id' => 4, 'locale' => 'en', 'name' => 'Feature Phones', 'slug' => 'feature-phones', 'description' => 'Simple and reliable feature phones', 'meta_title' => 'Feature Phones', 'meta_description' => 'Simple feature phones', 'meta_keywords' => 'feature phones, basic phones'],

            // Phone Cases & Covers
            ['category_id' => 5, 'locale' => 'ar', 'name' => 'أغطية وجرابات الهواتف', 'slug' => 'اغطية-جرابات-الهواتف', 'description' => 'حماية هاتفك بأفضل الأغطية والجرابات', 'meta_title' => 'أغطية الهواتف', 'meta_description' => 'أغطية وجرابات للهواتف', 'meta_keywords' => 'جرابات, أغطية, حماية الهاتف'],
            ['category_id' => 5, 'locale' => 'en', 'name' => 'Phone Cases & Covers', 'slug' => 'phone-cases-covers', 'description' => 'Protect your phone with the best cases and covers', 'meta_title' => 'Phone Cases', 'meta_description' => 'Phone cases and covers', 'meta_keywords' => 'cases, covers, phone protection'],

            // Screen Protectors
            ['category_id' => 6, 'locale' => 'ar', 'name' => 'واقيات الشاشة', 'slug' => 'واقيات-الشاشة', 'description' => 'احم شاشة هاتفك بواقيات عالية الجودة', 'meta_title' => 'واقيات الشاشة', 'meta_description' => 'واقيات شاشة للهواتف', 'meta_keywords' => 'واقي شاشة, حماية الشاشة'],
            ['category_id' => 6, 'locale' => 'en', 'name' => 'Screen Protectors', 'slug' => 'screen-protectors', 'description' => 'Protect your phone screen with high-quality protectors', 'meta_title' => 'Screen Protectors', 'meta_description' => 'Phone screen protectors', 'meta_keywords' => 'screen protector, tempered glass'],

            // Chargers & Cables
            ['category_id' => 7, 'locale' => 'ar', 'name' => 'الشواحن والكابلات', 'slug' => 'الشواحن-والكابلات', 'description' => 'شواحن وكابلات أصلية وعالية الجودة', 'meta_title' => 'الشواحن والكابلات', 'meta_description' => 'شواحن وكابلات للهواتف', 'meta_keywords' => 'شواحن, كابلات, USB'],
            ['category_id' => 7, 'locale' => 'en', 'name' => 'Chargers & Cables', 'slug' => 'chargers-cables', 'description' => 'Original and high-quality chargers and cables', 'meta_title' => 'Chargers & Cables', 'meta_description' => 'Phone chargers and cables', 'meta_keywords' => 'chargers, cables, USB'],

            // Power Banks
            ['category_id' => 8, 'locale' => 'ar', 'name' => 'بطاريات محمولة', 'slug' => 'بطاريات-محمولة', 'description' => 'باور بانك بسعات مختلفة لشحن أجهزتك', 'meta_title' => 'بطاريات محمولة', 'meta_description' => 'باور بانك وبطاريات محمولة', 'meta_keywords' => 'باور بانك, بطارية محمولة, شحن'],
            ['category_id' => 8, 'locale' => 'en', 'name' => 'Power Banks', 'slug' => 'power-banks', 'description' => 'Power banks with different capacities to charge your devices', 'meta_title' => 'Power Banks', 'meta_description' => 'Power banks and portable chargers', 'meta_keywords' => 'power bank, portable charger'],

            // Computers
            ['category_id' => 9, 'locale' => 'ar', 'name' => 'أجهزة الكمبيوتر', 'slug' => 'اجهزة-الكمبيوتر', 'description' => 'أجهزة كمبيوتر مكتبية وملحقاتها', 'meta_title' => 'أجهزة الكمبيوتر', 'meta_description' => 'تسوق أجهزة الكمبيوتر', 'meta_keywords' => 'كمبيوتر, حاسوب, PC'],
            ['category_id' => 9, 'locale' => 'en', 'name' => 'Computers', 'slug' => 'computers', 'description' => 'Desktop computers and accessories', 'meta_title' => 'Computers', 'meta_description' => 'Shop computers', 'meta_keywords' => 'computer, PC, desktop'],

            // Desktop Computers
            ['category_id' => 10, 'locale' => 'ar', 'name' => 'أجهزة الكمبيوتر المكتبية', 'slug' => 'الكمبيوتر-المكتبي', 'description' => 'أجهزة كمبيوتر مكتبية للمنزل والعمل', 'meta_title' => 'كمبيوتر مكتبي', 'meta_description' => 'أجهزة كمبيوتر مكتبية', 'meta_keywords' => 'كمبيوتر مكتبي, ديسكتوب'],
            ['category_id' => 10, 'locale' => 'en', 'name' => 'Desktop Computers', 'slug' => 'desktop-computers', 'description' => 'Desktop computers for home and work', 'meta_title' => 'Desktop Computers', 'meta_description' => 'Desktop computers', 'meta_keywords' => 'desktop, computer, PC'],

            // All-in-One PCs
            ['category_id' => 11, 'locale' => 'ar', 'name' => 'أجهزة الكل في واحد', 'slug' => 'الكل-في-واحد', 'description' => 'أجهزة All-in-One بتصميم أنيق ومساحة أقل', 'meta_title' => 'الكل في واحد', 'meta_description' => 'أجهزة كمبيوتر الكل في واحد', 'meta_keywords' => 'الكل في واحد, AIO'],
            ['category_id' => 11, 'locale' => 'en', 'name' => 'All-in-One PCs', 'slug' => 'all-in-one-pcs', 'description' => 'All-in-One PCs with elegant design and less space', 'meta_title' => 'All-in-One PCs', 'meta_description' => 'All-in-One computers', 'meta_keywords' => 'all-in-one, AIO, computer'],

            // Monitors
            ['category_id' => 12, 'locale' => 'ar', 'name' => 'الشاشات', 'slug' => 'الشاشات', 'description' => 'شاشات كمبيوتر بمختلف الأحجام والدقة', 'meta_title' => 'شاشات الكمبيوتر', 'meta_description' => 'شاشات كمبيوتر', 'meta_keywords' => 'شاشة, مونيتور, عرض'],
            ['category_id' => 12, 'locale' => 'en', 'name' => 'Monitors', 'slug' => 'monitors', 'description' => 'Computer monitors in various sizes and resolutions', 'meta_title' => 'Computer Monitors', 'meta_description' => 'Computer monitors', 'meta_keywords' => 'monitor, display, screen'],

            // Computer Components
            ['category_id' => 13, 'locale' => 'ar', 'name' => 'مكونات الكمبيوتر', 'slug' => 'مكونات-الكمبيوتر', 'description' => 'معالجات وكروت شاشة ولوحات أم وذاكرة', 'meta_title' => 'مكونات الكمبيوتر', 'meta_description' => 'قطع غيار ومكونات الكمبيوتر', 'meta_keywords' => 'معالج, كرت شاشة, رام, ذاكرة'],
            ['category_id' => 13, 'locale' => 'en', 'name' => 'Computer Components', 'slug' => 'computer-components', 'description' => 'Processors, graphics cards, motherboards and memory', 'meta_title' => 'Computer Components', 'meta_description' => 'Computer parts and components', 'meta_keywords' => 'CPU, GPU, RAM, motherboard'],

            // PC Gaming
            ['category_id' => 14, 'locale' => 'ar', 'name' => 'ألعاب الكمبيوتر', 'slug' => 'العاب-الكمبيوتر', 'description' => 'أجهزة ومستلزمات الألعاب للكمبيوتر', 'meta_title' => 'ألعاب الكمبيوتر', 'meta_description' => 'أجهزة الألعاب للكمبيوتر', 'meta_keywords' => 'قيمنق, ألعاب, PC gaming'],
            ['category_id' => 14, 'locale' => 'en', 'name' => 'PC Gaming', 'slug' => 'pc-gaming', 'description' => 'Gaming equipment and accessories for PC', 'meta_title' => 'PC Gaming', 'meta_description' => 'PC gaming equipment', 'meta_keywords' => 'gaming, PC gaming, gamer'],

            // Laptops
            ['category_id' => 15, 'locale' => 'ar', 'name' => 'أجهزة اللابتوب', 'slug' => 'اللابتوب', 'description' => 'أجهزة لابتوب للعمل والألعاب والدراسة', 'meta_title' => 'أجهزة اللابتوب', 'meta_description' => 'تسوق أجهزة اللابتوب', 'meta_keywords' => 'لابتوب, كمبيوتر محمول, نوت بوك'],
            ['category_id' => 15, 'locale' => 'en', 'name' => 'Laptops', 'slug' => 'laptops', 'description' => 'Laptops for work, gaming and study', 'meta_title' => 'Laptops', 'meta_description' => 'Shop laptops', 'meta_keywords' => 'laptop, notebook, portable computer'],

            // Gaming Laptops
            ['category_id' => 16, 'locale' => 'ar', 'name' => 'لابتوب ألعاب', 'slug' => 'لابتوب-العاب', 'description' => 'أجهزة لابتوب قوية للألعاب', 'meta_title' => 'لابتوب ألعاب', 'meta_description' => 'لابتوب للألعاب', 'meta_keywords' => 'لابتوب ألعاب, قيمنق لابتوب'],
            ['category_id' => 16, 'locale' => 'en', 'name' => 'Gaming Laptops', 'slug' => 'gaming-laptops', 'description' => 'Powerful gaming laptops', 'meta_title' => 'Gaming Laptops', 'meta_description' => 'Gaming laptops', 'meta_keywords' => 'gaming laptop, gaming notebook'],

            // Business Laptops
            ['category_id' => 17, 'locale' => 'ar', 'name' => 'لابتوب للأعمال', 'slug' => 'لابتوب-للاعمال', 'description' => 'أجهزة لابتوب موثوقة للأعمال والمهنيين', 'meta_title' => 'لابتوب للأعمال', 'meta_description' => 'لابتوب للأعمال', 'meta_keywords' => 'لابتوب أعمال, لابتوب مهني'],
            ['category_id' => 17, 'locale' => 'en', 'name' => 'Business Laptops', 'slug' => 'business-laptops', 'description' => 'Reliable laptops for business and professionals', 'meta_title' => 'Business Laptops', 'meta_description' => 'Business laptops', 'meta_keywords' => 'business laptop, professional laptop'],

            // Ultrabooks
            ['category_id' => 18, 'locale' => 'ar', 'name' => 'ألترابوك', 'slug' => 'الترابوك', 'description' => 'أجهزة لابتوب خفيفة ورفيعة', 'meta_title' => 'ألترابوك', 'meta_description' => 'أجهزة ألترابوك', 'meta_keywords' => 'ألترابوك, لابتوب خفيف, رفيع'],
            ['category_id' => 18, 'locale' => 'en', 'name' => 'Ultrabooks', 'slug' => 'ultrabooks', 'description' => 'Thin and light laptop devices', 'meta_title' => 'Ultrabooks', 'meta_description' => 'Ultrabook devices', 'meta_keywords' => 'ultrabook, thin laptop, light laptop'],

            // 2-in-1 Laptops
            ['category_id' => 19, 'locale' => 'ar', 'name' => 'لابتوب 2 في 1', 'slug' => 'لابتوب-2-في-1', 'description' => 'أجهزة لابتوب قابلة للتحويل إلى تابلت', 'meta_title' => 'لابتوب 2 في 1', 'meta_description' => 'لابتوب قابل للتحويل', 'meta_keywords' => '2 في 1, لابتوب تابلت, قابل للتحويل'],
            ['category_id' => 19, 'locale' => 'en', 'name' => '2-in-1 Laptops', 'slug' => '2-in-1-laptops', 'description' => 'Convertible laptops that transform into tablets', 'meta_title' => '2-in-1 Laptops', 'meta_description' => 'Convertible laptops', 'meta_keywords' => '2-in-1, convertible, laptop tablet'],

            // Chromebooks
            ['category_id' => 20, 'locale' => 'ar', 'name' => 'كروم بوك', 'slug' => 'كروم-بوك', 'description' => 'أجهزة كروم بوك بنظام Chrome OS', 'meta_title' => 'كروم بوك', 'meta_description' => 'أجهزة كروم بوك', 'meta_keywords' => 'كروم بوك, Chrome OS'],
            ['category_id' => 20, 'locale' => 'en', 'name' => 'Chromebooks', 'slug' => 'chromebooks', 'description' => 'Chromebook devices with Chrome OS', 'meta_title' => 'Chromebooks', 'meta_description' => 'Chromebook devices', 'meta_keywords' => 'chromebook, Chrome OS'],

            // Laptop Bags & Sleeves
            ['category_id' => 21, 'locale' => 'ar', 'name' => 'حقائب اللابتوب', 'slug' => 'حقائب-اللابتوب', 'description' => 'حقائب وأغلفة لحماية اللابتوب', 'meta_title' => 'حقائب اللابتوب', 'meta_description' => 'حقائب وأغلفة اللابتوب', 'meta_keywords' => 'حقيبة لابتوب, غلاف لابتوب'],
            ['category_id' => 21, 'locale' => 'en', 'name' => 'Laptop Bags & Sleeves', 'slug' => 'laptop-bags-sleeves', 'description' => 'Bags and sleeves to protect your laptop', 'meta_title' => 'Laptop Bags', 'meta_description' => 'Laptop bags and sleeves', 'meta_keywords' => 'laptop bag, laptop sleeve, case'],

            // Accessories
            ['category_id' => 22, 'locale' => 'ar', 'name' => 'اكسسوارات', 'slug' => 'اكسسوارات', 'description' => 'ملحقات واكسسوارات الكمبيوتر واللابتوب', 'meta_title' => 'اكسسوارات', 'meta_description' => 'اكسسوارات الكمبيوتر', 'meta_keywords' => 'اكسسوارات, ملحقات, accessories'],
            ['category_id' => 22, 'locale' => 'en', 'name' => 'Accessories', 'slug' => 'accessories', 'description' => 'Computer and laptop accessories', 'meta_title' => 'Accessories', 'meta_description' => 'Computer accessories', 'meta_keywords' => 'accessories, peripherals'],

            // Keyboards
            ['category_id' => 23, 'locale' => 'ar', 'name' => 'لوحات المفاتيح', 'slug' => 'لوحات-المفاتيح', 'description' => 'لوحات مفاتيح سلكية ولاسلكية', 'meta_title' => 'لوحات المفاتيح', 'meta_description' => 'لوحات مفاتيح', 'meta_keywords' => 'كيبورد, لوحة مفاتيح'],
            ['category_id' => 23, 'locale' => 'en', 'name' => 'Keyboards', 'slug' => 'keyboards', 'description' => 'Wired and wireless keyboards', 'meta_title' => 'Keyboards', 'meta_description' => 'Keyboards', 'meta_keywords' => 'keyboard, mechanical, wireless'],

            // Mice & Trackpads
            ['category_id' => 24, 'locale' => 'ar', 'name' => 'الماوس', 'slug' => 'الماوس', 'description' => 'ماوس سلكية ولاسلكية للكمبيوتر', 'meta_title' => 'الماوس', 'meta_description' => 'ماوس الكمبيوتر', 'meta_keywords' => 'ماوس, فأرة, mouse'],
            ['category_id' => 24, 'locale' => 'en', 'name' => 'Mice & Trackpads', 'slug' => 'mice-trackpads', 'description' => 'Wired and wireless mice for computer', 'meta_title' => 'Mice', 'meta_description' => 'Computer mice', 'meta_keywords' => 'mouse, mice, trackpad'],

            // Headphones & Earbuds
            ['category_id' => 25, 'locale' => 'ar', 'name' => 'السماعات', 'slug' => 'السماعات', 'description' => 'سماعات رأس وسماعات أذن', 'meta_title' => 'السماعات', 'meta_description' => 'سماعات رأس وأذن', 'meta_keywords' => 'سماعات, هيدفون, ايربودز'],
            ['category_id' => 25, 'locale' => 'en', 'name' => 'Headphones & Earbuds', 'slug' => 'headphones-earbuds', 'description' => 'Headphones and earbuds', 'meta_title' => 'Headphones', 'meta_description' => 'Headphones and earbuds', 'meta_keywords' => 'headphones, earbuds, headset'],

            // Speakers
            ['category_id' => 26, 'locale' => 'ar', 'name' => 'مكبرات الصوت', 'slug' => 'مكبرات-الصوت', 'description' => 'سماعات خارجية ومكبرات صوت', 'meta_title' => 'مكبرات الصوت', 'meta_description' => 'مكبرات صوت', 'meta_keywords' => 'سبيكر, مكبر صوت, speakers'],
            ['category_id' => 26, 'locale' => 'en', 'name' => 'Speakers', 'slug' => 'speakers', 'description' => 'External speakers and sound systems', 'meta_title' => 'Speakers', 'meta_description' => 'Computer speakers', 'meta_keywords' => 'speakers, sound, audio'],

            // Webcams
            ['category_id' => 27, 'locale' => 'ar', 'name' => 'كاميرات الويب', 'slug' => 'كاميرات-الويب', 'description' => 'كاميرات ويب للمكالمات والبث', 'meta_title' => 'كاميرات الويب', 'meta_description' => 'كاميرات ويب', 'meta_keywords' => 'ويب كام, كاميرا, webcam'],
            ['category_id' => 27, 'locale' => 'en', 'name' => 'Webcams', 'slug' => 'webcams', 'description' => 'Webcams for calls and streaming', 'meta_title' => 'Webcams', 'meta_description' => 'Webcams', 'meta_keywords' => 'webcam, camera, streaming'],

            // USB Hubs & Adapters
            ['category_id' => 28, 'locale' => 'ar', 'name' => 'موزعات ومحولات USB', 'slug' => 'موزعات-محولات-usb', 'description' => 'موزعات USB ومحولات متعددة', 'meta_title' => 'موزعات USB', 'meta_description' => 'موزعات ومحولات', 'meta_keywords' => 'USB hub, محول, موزع'],
            ['category_id' => 28, 'locale' => 'en', 'name' => 'USB Hubs & Adapters', 'slug' => 'usb-hubs-adapters', 'description' => 'USB hubs and multi-port adapters', 'meta_title' => 'USB Hubs', 'meta_description' => 'USB hubs and adapters', 'meta_keywords' => 'USB hub, adapter, port'],

            // External Storage
            ['category_id' => 29, 'locale' => 'ar', 'name' => 'التخزين الخارجي', 'slug' => 'التخزين-الخارجي', 'description' => 'هاردات خارجية و SSD محمولة', 'meta_title' => 'التخزين الخارجي', 'meta_description' => 'أجهزة تخزين خارجية', 'meta_keywords' => 'هارد خارجي, SSD, تخزين'],
            ['category_id' => 29, 'locale' => 'en', 'name' => 'External Storage', 'slug' => 'external-storage', 'description' => 'External hard drives and portable SSDs', 'meta_title' => 'External Storage', 'meta_description' => 'External storage devices', 'meta_keywords' => 'external drive, SSD, HDD, storage'],

            // Cables & Connectors
            ['category_id' => 30, 'locale' => 'ar', 'name' => 'الكابلات والموصلات', 'slug' => 'الكابلات-والموصلات', 'description' => 'كابلات وموصلات متنوعة', 'meta_title' => 'الكابلات', 'meta_description' => 'كابلات وموصلات', 'meta_keywords' => 'كابل, موصل, HDMI, USB'],
            ['category_id' => 30, 'locale' => 'en', 'name' => 'Cables & Connectors', 'slug' => 'cables-connectors', 'description' => 'Various cables and connectors', 'meta_title' => 'Cables', 'meta_description' => 'Cables and connectors', 'meta_keywords' => 'cable, connector, HDMI, USB'],
        ];

        foreach ($translations as $translation) {
            DB::table('category_translations')->insert(array_merge($translation, [
                'url_path' => '',
                'locale_id' => null,
            ]));
        }

        // ============================
        // FILTERABLE ATTRIBUTES
        // Add price (attribute_id: 11) as filterable for main categories
        // ============================
        $filterableCategories = [2, 9, 15, 22]; // Main categories

        foreach ($filterableCategories as $categoryId) {
            DB::table('category_filterable_attributes')->insert([
                'category_id' => $categoryId,
                'attribute_id' => 11, // Price attribute
            ]);
        }

        $this->command->info('✅ Electronics categories seeded successfully!');
        $this->command->info('   - 30 categories created');
        $this->command->info('   - 60 translations (Arabic & English)');
        $this->command->info('   - 4 filterable attribute configurations');
    }
}
