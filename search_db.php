<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = DB::select('SHOW TABLES');
foreach ($tables as $table) {
    $tableName = array_values((array)$table)[0];
    $columns = DB::select("SHOW COLUMNS FROM `$tableName`");
    foreach ($columns as $column) {
        if (strpos($column->Type, 'char') !== false || strpos($column->Type, 'text') !== false || strpos($column->Type, 'longtext') !== false) {
            $count = DB::table($tableName)->where($column->Field, 'like', '%tiktok%')->count();
            if ($count > 0) {
                echo "Found in table: $tableName, column: {$column->Field}\n";
            }
        }
    }
}
