<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Webkul\Theme\Models\ThemeCustomization;

$theme = ThemeCustomization::where('type', 'category_carousel')->first();
if ($theme) {
    echo "=== RAW DB options field ===\n";
    echo json_encode($theme->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n\n";

    echo "=== ThemeCustomization model attributes ===\n";
    print_r($theme->getAttributes());
    echo "\n\n";

    echo "=== Translations ===\n";
    foreach ($theme->translations as $t) {
        echo "Locale: " . $t->locale . "\n";
        echo "Options: " . json_encode($t->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n\n";
    }
}
