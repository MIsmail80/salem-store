<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Webkul\Theme\Models\ThemeCustomization;

$theme = ThemeCustomization::where('type', 'category_carousel')->first();
if ($theme) {
    $options = $theme->options;
    if (isset($options['filters'])) {
        $options['filters']['limit'] = 30; // Increased to 30 to cover all 16 categories
    }
    
    // Theme customization options are translatable, so we need to update the translated attributes too
    $locale = core()->getRequestedLocaleCode() ?? 'ar';
    $translatedModel = $theme->translate($locale);
    if ($translatedModel) {
        $translatedOptions = $translatedModel->options;
        $translatedOptions['filters']['limit'] = 30;
        $translatedModel->options = $translatedOptions;
        $translatedModel->save();
    }
    
    // Also update english just in case
    $translatedModelEn = $theme->translate('en');
    if ($translatedModelEn) {
        $translatedOptionsEn = $translatedModelEn->options;
        $translatedOptionsEn['filters']['limit'] = 30;
        $translatedModelEn->options = $translatedOptionsEn;
        $translatedModelEn->save();
    }

    $theme->options = $options;
    $theme->save();
    echo "Limit updated to 30!\n";
} else {
    echo "Theme not found\n";
}
