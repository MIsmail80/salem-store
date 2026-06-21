<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Render the home page HTML and extract the category carousel src URL
$request = Illuminate\Http\Request::create('/', 'GET');
app()->instance('request', $request);

// Get customizations the same way the controller does
$repo = app(\Webkul\Theme\Repositories\ThemeCustomizationRepository::class);
$customizations = $repo->orderBy('sort_order')->findWhere([
    'status'     => 1,
    'channel_id' => core()->getCurrentChannel()->id,
    'theme_code' => core()->getCurrentChannel()->theme,
]);

foreach ($customizations as $customization) {
    if ($customization->type === 'category_carousel') {
        $data = $customization->options;
        $filters = $data['filters'] ?? [];
        $merged = array_merge($filters, ['include_all_statuses' => 1]);
        $url = route('shop.api.categories.index', $merged);
        echo "Carousel src URL: " . $url . "\n";
        echo "limit = " . ($filters['limit'] ?? 'not set') . "\n";
        echo "parent_id = " . ($filters['parent_id'] ?? 'not set') . "\n";
    }
}
