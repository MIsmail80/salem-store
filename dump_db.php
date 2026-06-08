<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$res = DB::table('cms_page_translations')->where('url_key', 'touch-me')->first();
file_put_contents('db_dump.txt', $res->html_content);
echo "Dumped html_content to db_dump.txt\n";
