<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/api/categories', 'GET', [
    'include_all_statuses' => 1,
    'parent_id' => 1,
    'limit' => 30,
    'sort' => 'asc',
    'locale' => 'ar',
]);
app()->instance('request', $request);

$controller = app()->make(\Webkul\Shop\Http\Controllers\API\CategoryController::class);
$response = $controller->index();
$data = $response->toResponse($request)->getData(true);

echo "Total categories returned: " . $data['meta']['total'] . "\n";
echo "Per page: " . $data['meta']['per_page'] . "\n\n";

echo "Categories:\n";
foreach ($data['data'] as $cat) {
    echo "- " . $cat['name'] . " (ID: " . $cat['id'] . ", Status: " . $cat['status'] . ")\n";
}
