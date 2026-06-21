<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Webkul\Category\Models\Category;
use Webkul\Core\Models\Channel;

$rootCategoryId = Channel::first()->root_category_id ?? 1;
$rootCategory = Category::find($rootCategoryId);

if (!$rootCategory) {
    echo "Root category not found.\n";
    exit;
}

echo "Root Category: " . $rootCategory->name . " (ID: " . $rootCategory->id . ")\n";
echo "Subcategories:\n";

$subcategories = Category::where('parent_id', $rootCategoryId)->get();

foreach ($subcategories as $category) {
    echo "- " . $category->name . " (ID: " . $category->id . ", Status: " . ($category->status ? 'Active' : 'Inactive') . ")\n";
}
