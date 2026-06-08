<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$res = DB::table('theme_customization_translations')->get();
file_put_contents('theme_dump.json', json_encode($res->toArray(), JSON_UNESCAPED_UNICODE));
echo "Dumped theme customizations to theme_dump.json\n";
