<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$res = DB::table('cms_page_translations')->where('html_content', 'like', '%tiktok%')->get(['id', 'cms_page_id', 'url_key', 'locale']);
echo "Pages with tiktok:\n";
print_r($res->toArray());

$res2 = DB::table('cms_page_translations')->where('url_key', 'touch-me')->get(['id', 'cms_page_id', 'url_key', 'locale', 'page_title']);
echo "\nPages with touch-me:\n";
print_r($res2->toArray());
