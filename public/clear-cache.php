<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

\Illuminate\Support\Facades\Artisan::call('optimize:clear');
\Illuminate\Support\Facades\Artisan::call('responsecache:clear');
\Illuminate\Support\Facades\Cache::flush();
try {
    \Illuminate\Support\Facades\Redis::flushall();
} catch (\Exception $e) {}

if (function_exists('opcache_reset')) {
    opcache_reset();
}

echo "All caches cleared!";
