<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$items = DB::table('theme_customizations')->orderBy('sort_order')->get(['id', 'type', 'name', 'status', 'sort_order']);

$output = [];
foreach ($items as $item) {
    $output[] = [
        'id' => $item->id,
        'type' => $item->type,
        'name' => $item->name,
        'status' => $item->status ? 'ON' : 'OFF',
        'sort_order' => $item->sort_order
    ];
}

file_put_contents(__DIR__ . '/customizations.json', json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Written to customizations.json\n";
echo "Total: " . count($output) . " items\n";
