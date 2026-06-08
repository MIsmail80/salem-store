<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$htmlContent = file_get_contents(__DIR__ . '/touch-me-cms-content.html');

$updated = DB::table('cms_page_translations')
    ->where('url_key', 'touch-me')
    ->update(['html_content' => $htmlContent]);

echo "Updated $updated rows in cms_page_translations with url_key='touch-me'.\n";
