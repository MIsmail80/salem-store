<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $egypt = DB::table('countries')->where('code', 'EG')->first();

        if (!$egypt) {
            return;
        }

        $states = [
            ['code' => 'EG-ALX', 'default_name' => 'Alexandria', 'ar' => 'الإسكندرية'],
            ['code' => 'EG-ASN', 'default_name' => 'Aswan', 'ar' => 'أسوان'],
            ['code' => 'EG-AST', 'default_name' => 'Asyut', 'ar' => 'أسيوط'],
            ['code' => 'EG-BA', 'default_name' => 'Red Sea', 'ar' => 'البحر الأحمر'],
            ['code' => 'EG-BH', 'default_name' => 'Beheira', 'ar' => 'البحيرة'],
            ['code' => 'EG-BNS', 'default_name' => 'Beni Suef', 'ar' => 'بني سويف'],
            ['code' => 'EG-C', 'default_name' => 'Cairo', 'ar' => 'القاهرة'],
            ['code' => 'EG-DK', 'default_name' => 'Dakahlia', 'ar' => 'الدقهلية'],
            ['code' => 'EG-DT', 'default_name' => 'Damietta', 'ar' => 'دمياط'],
            ['code' => 'EG-FYM', 'default_name' => 'Fayoum', 'ar' => 'الفيوم'],
            ['code' => 'EG-GH', 'default_name' => 'Gharbia', 'ar' => 'الغربية'],
            ['code' => 'EG-GZ', 'default_name' => 'Giza', 'ar' => 'الجيزة'],
            ['code' => 'EG-IS', 'default_name' => 'Ismailia', 'ar' => 'الإسماعيلية'],
            ['code' => 'EG-JS', 'default_name' => 'South Sinai', 'ar' => 'جنوب سيناء'],
            ['code' => 'EG-KB', 'default_name' => 'Qalyubia', 'ar' => 'القليوبية'],
            ['code' => 'EG-KFS', 'default_name' => 'Kafr El Sheikh', 'ar' => 'كفر الشيخ'],
            ['code' => 'EG-KN', 'default_name' => 'Qena', 'ar' => 'قنا'],
            ['code' => 'EG-LX', 'default_name' => 'Luxor', 'ar' => 'الأقصر'],
            ['code' => 'EG-MN', 'default_name' => 'Minya', 'ar' => 'المنيا'],
            ['code' => 'EG-MNF', 'default_name' => 'Monufia', 'ar' => 'المنوفية'],
            ['code' => 'EG-MT', 'default_name' => 'Matrouh', 'ar' => 'مطروح'],
            ['code' => 'EG-PTS', 'default_name' => 'Port Said', 'ar' => 'بورسعيد'],
            ['code' => 'EG-SHG', 'default_name' => 'Sohag', 'ar' => 'سوهاج'],
            ['code' => 'EG-SHR', 'default_name' => 'Sharqia', 'ar' => 'الشرقية'],
            ['code' => 'EG-SIN', 'default_name' => 'North Sinai', 'ar' => 'شمال سيناء'],
            ['code' => 'EG-SUZ', 'default_name' => 'Suez', 'ar' => 'السويس'],
            ['code' => 'EG-WAD', 'default_name' => 'New Valley', 'ar' => 'الوادي الجديد'],
        ];

        foreach ($states as $state) {
            // Check if exists
            $exists = DB::table('country_states')
                ->where('country_id', $egypt->id)
                ->where('code', $state['code'])
                ->exists();

            if (!$exists) {
                $stateId = DB::table('country_states')->insertGetId([
                    'country_id' => $egypt->id,
                    'country_code' => 'EG',
                    'code' => $state['code'],
                    'default_name' => $state['default_name'],
                ]);

                // Insert Arabic Translation
                DB::table('country_state_translations')->insert([
                    'country_state_id' => $stateId,
                    'locale' => 'ar',
                    'default_name' => $state['ar'],
                ]);

                // Insert English Translation
                DB::table('country_state_translations')->insert([
                    'country_state_id' => $stateId,
                    'locale' => 'en',
                    'default_name' => $state['default_name'],
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $egypt = DB::table('countries')->where('code', 'EG')->first();
        if ($egypt) {
            DB::table('country_states')->where('country_id', $egypt->id)->delete();
        }
    }
};
