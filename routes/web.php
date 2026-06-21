<?php
use Illuminate\Support\Facades\Route;

Route::get('/clear-my-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    \Illuminate\Support\Facades\Artisan::call('responsecache:clear');
    \Illuminate\Support\Facades\Cache::flush();
    if (function_exists('opcache_reset')) {
        opcache_reset();
    }
    return 'Cache Cleared!';
});
