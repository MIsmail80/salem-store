<?php
// Script to toggle static content sections on/off
// Usage: php toggle_static.php [on|off] [id1,id2,...]

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$action = $argv[1] ?? 'list';
$ids = isset($argv[2]) ? explode(',', $argv[2]) : [];

if ($action === 'list') {
    echo "Current static_content sections:\n\n";
    $items = DB::table('theme_customizations')
        ->where('type', 'static_content')
        ->orderBy('sort_order')
        ->get(['id', 'name', 'status', 'sort_order']);

    foreach ($items as $item) {
        $status = $item->status ? 'ON ' : 'OFF';
        echo "ID {$item->id} | {$status} | Order: {$item->sort_order} | {$item->name}\n";
    }
    echo "\nUsage: php toggle_static.php [on|off] [id1,id2,...]\n";
    echo "Example: php toggle_static.php off 2,5,6\n";
} elseif ($action === 'off' && !empty($ids)) {
    DB::table('theme_customizations')
        ->whereIn('id', $ids)
        ->update(['status' => 0]);
    echo "Disabled sections: " . implode(', ', $ids) . "\n";
} elseif ($action === 'on' && !empty($ids)) {
    DB::table('theme_customizations')
        ->whereIn('id', $ids)
        ->update(['status' => 1]);
    echo "Enabled sections: " . implode(', ', $ids) . "\n";
} else {
    echo "Usage: php toggle_static.php [on|off|list] [id1,id2,...]\n";
}
