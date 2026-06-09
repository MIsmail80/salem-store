<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$rows = DB::table('cms_page_translations')->where('url_key', 'touch-me')->get(['id', 'locale', 'page_title']);
print_r($rows->toArray());
