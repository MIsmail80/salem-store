<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Webkul\Theme\Models\ThemeCustomization;
use Webkul\Theme\Repositories\ThemeCustomizationRepository;

$repo = app(ThemeCustomizationRepository::class);
$customizations = $repo->orderBy('sort_order')->findWhere([
    'status'     => 1,
    'channel_id' => core()->getCurrentChannel()->id,
    'theme_code' => core()->getCurrentChannel()->theme,
]);

$channel = core()->getCurrentChannel();
echo "Current locale: " . app()->getLocale() . "\n";
echo "Channel theme: " . $channel->theme . "\n\n";

foreach ($customizations as $customization) {
    if ($customization->type === 'category_carousel') {
        echo "=== category_carousel ===\n";
        $data = $customization->options;
        echo "options: " . json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n\n";
        
        // Simulate what the blade does
        $filters = $data['filters'] ?? [];
        echo "filters used for route: " . json_encode($filters, JSON_UNESCAPED_UNICODE) . "\n";
        
        $merged = array_merge($filters, ['include_all_statuses' => 1]);
        echo "merged filters: " . json_encode($merged, JSON_UNESCAPED_UNICODE) . "\n\n";
        
        $url = route('shop.api.categories.index', $merged);
        echo "Generated URL: " . $url . "\n";
    }
}
