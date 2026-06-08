<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$res = DB::table('cms_page_translations')->get(['id', 'url_key', 'locale', 'html_content']);
foreach ($res as $row) {
    if (strpos($row->html_content, 'tiktok') !== false) {
        echo "Found tiktok in ID: {$row->id}, url_key: {$row->url_key}\n";
    }
    if (strpos($row->html_content, 'min-height: 100vh') !== false) {
        echo "Found min-height in ID: {$row->id}, url_key: {$row->url_key}\n";
    }
}
echo "Done checking cms_page_translations.\n";
