<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/api/categories', 'GET', [
    'include_all_statuses' => 1,
    'parent_id' => 1,
    'limit' => 20
]);
app()->instance('request', $request);

$controller = app()->make(\Webkul\Shop\Http\Controllers\API\CategoryController::class);
$response = $controller->index();
echo json_encode($response->toResponse($request)->getData(true), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
