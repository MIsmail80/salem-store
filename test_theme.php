<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Webkul\Theme\Models\ThemeCustomization;

$theme = ThemeCustomization::where('type', 'category_carousel')->first();
if ($theme) {
    echo json_encode($theme->options, JSON_PRETTY_PRINT);
} else {
    echo "Theme not found";
}
