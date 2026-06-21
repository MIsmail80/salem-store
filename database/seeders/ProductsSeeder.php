<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Category\Models\Category;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRepository = app(ProductRepository::class);

        $rootCategory = Category::where('parent_id', null)->first();
        $categoryId = $rootCategory ? $rootCategory->id : 1;

        $products = [
            [
                'title' => 'iPhone 5s',
                'description' => 'The iPhone 5s is a classic smartphone known for its compact design and advanced features during its release. While it\'s an older model, it still provides a reliable user experience.',
                'price' => 199.99,
                'brand' => 'Apple',
                'sku' => 'SMA-APP-IPH-121',
                'weight' => 2,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-5s/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-5s/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-5s/3.webp',
                ],
            ],
            [
                'title' => 'iPhone 6',
                'description' => 'The iPhone 6 is a stylish and capable smartphone with a larger display and improved performance.',
                'price' => 299.99,
                'brand' => 'Apple',
                'sku' => 'SMA-APP-IPH-122',
                'weight' => 7,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-6/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-6/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-6/3.webp',
                ],
            ],
            [
                'title' => 'iPhone 13 Pro',
                'description' => 'The iPhone 13 Pro is a cutting-edge smartphone with a powerful camera system, high-performance chip, and stunning display.',
                'price' => 1099.99,
                'brand' => 'Apple',
                'sku' => 'SMA-APP-IPH-123',
                'weight' => 8,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-13-pro/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-13-pro/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-13-pro/3.webp',
                ],
            ],
            [
                'title' => 'iPhone X',
                'description' => 'The iPhone X is a flagship smartphone featuring a bezel-less OLED display, facial recognition technology (Face ID), and impressive performance.',
                'price' => 899.99,
                'brand' => 'Apple',
                'sku' => 'SMA-APP-IPH-124',
                'weight' => 1,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-x/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-x/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/iphone-x/3.webp',
                ],
            ],
            [
                'title' => 'Oppo A57',
                'description' => 'The Oppo A57 is a mid-range smartphone known for its sleek design and capable features.',
                'price' => 249.99,
                'brand' => 'Oppo',
                'sku' => 'SMA-OPP-OPP-125',
                'weight' => 5,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-a57/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-a57/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-a57/3.webp',
                ],
            ],
            [
                'title' => 'Oppo F19 Pro Plus',
                'description' => 'The Oppo F19 Pro Plus is a feature-rich smartphone with a focus on camera capabilities.',
                'price' => 399.99,
                'brand' => 'Oppo',
                'sku' => 'SMA-OPP-OPP-126',
                'weight' => 6,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-f19-pro-plus/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-f19-pro-plus/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-f19-pro-plus/3.webp',
                ],
            ],
            [
                'title' => 'Oppo K1',
                'description' => 'The Oppo K1 series offers a range of smartphones with various features and specifications.',
                'price' => 299.99,
                'brand' => 'Oppo',
                'sku' => 'SMA-OPP-OPP-127',
                'weight' => 5,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-k1/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-k1/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-k1/3.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/oppo-k1/4.webp',
                ],
            ],
            [
                'title' => 'Realme C35',
                'description' => 'The Realme C35 is a budget-friendly smartphone with a focus on providing essential features for everyday use.',
                'price' => 149.99,
                'brand' => 'Realme',
                'sku' => 'SMA-REA-REA-128',
                'weight' => 2,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/realme-c35/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/realme-c35/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/realme-c35/3.webp',
                ],
            ],
            [
                'title' => 'Realme X',
                'description' => 'The Realme X is a mid-range smartphone known for its sleek design and impressive display.',
                'price' => 299.99,
                'brand' => 'Realme',
                'sku' => 'SMA-REA-REA-129',
                'weight' => 4,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/realme-x/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/realme-x/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/realme-x/3.webp',
                ],
            ],
            [
                'title' => 'Realme XT',
                'description' => 'The Realme XT is a feature-rich smartphone with a focus on camera technology.',
                'price' => 349.99,
                'brand' => 'Realme',
                'sku' => 'SMA-REA-REA-130',
                'weight' => 3,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/realme-xt/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/realme-xt/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/realme-xt/3.webp',
                ],
            ],
            [
                'title' => 'Samsung Galaxy S7',
                'description' => 'The Samsung Galaxy S7 is a flagship smartphone known for its sleek design and advanced features.',
                'price' => 299.99,
                'brand' => 'Samsung',
                'sku' => 'SMA-SAM-SAM-131',
                'weight' => 10,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s7/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s7/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s7/3.webp',
                ],
            ],
            [
                'title' => 'Samsung Galaxy S8',
                'description' => 'The Samsung Galaxy S8 is a premium smartphone with an Infinity Display, offering a stunning visual experience.',
                'price' => 499.99,
                'brand' => 'Samsung',
                'sku' => 'SMA-SAM-SAM-132',
                'weight' => 6,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s8/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s8/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s8/3.webp',
                ],
            ],
            [
                'title' => 'Samsung Galaxy S10',
                'description' => 'The Samsung Galaxy S10 is a flagship device featuring a dynamic AMOLED display, versatile camera system, and powerful performance.',
                'price' => 699.99,
                'brand' => 'Samsung',
                'sku' => 'SMA-SAM-SAM-133',
                'weight' => 9,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s10/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s10/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s10/3.webp',
                ],
            ],
            [
                'title' => 'Vivo S1',
                'description' => 'The Vivo S1 is a stylish and mid-range smartphone offering a blend of design and performance.',
                'price' => 249.99,
                'brand' => 'Vivo',
                'sku' => 'SMA-VIV-VIV-134',
                'weight' => 4,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/vivo-s1/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/vivo-s1/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/vivo-s1/3.webp',
                ],
            ],
            [
                'title' => 'Vivo V9',
                'description' => 'The Vivo V9 is a smartphone known for its sleek design and emphasis on capturing high-quality selfies.',
                'price' => 299.99,
                'brand' => 'Vivo',
                'sku' => 'SMA-VIV-VIV-135',
                'weight' => 4,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/vivo-v9/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/vivo-v9/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/vivo-v9/3.webp',
                ],
            ],
            [
                'title' => 'Vivo X21',
                'description' => 'The Vivo X21 is a premium smartphone with a focus on cutting-edge technology.',
                'price' => 499.99,
                'brand' => 'Vivo',
                'sku' => 'SMA-VIV-VIV-136',
                'weight' => 10,
                'images' => [
                    'https://cdn.dummyjson.com/product-images/smartphones/vivo-x21/1.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/vivo-x21/2.webp',
                    'https://cdn.dummyjson.com/product-images/smartphones/vivo-x21/3.webp',
                ],
            ],
            [
                'title' => 'Joyroom JR-T03S TWS Earbuds',
                'description' => 'True wireless earbuds with active noise cancellation and high quality sound.',
                'price' => 49.99,
                'brand' => 'Joyroom',
                'sku' => 'JR-T03S',
                'weight' => 1,
                'images' => [
                    'https://placehold.co/600x600/EEE/31343C?text=Joyroom+Earbuds',
                ],
            ],
            [
                'title' => 'Joyroom 20W Fast Charger',
                'description' => 'Compact 20W fast charger with PD support.',
                'price' => 19.99,
                'brand' => 'Joyroom',
                'sku' => 'JR-FC20',
                'weight' => 1,
                'images' => [
                    'https://placehold.co/600x600/EEE/31343C?text=Joyroom+Charger',
                ],
            ],
            [
                'title' => 'Anker PowerCore 10000',
                'description' => 'One of the smallest and lightest 10000mAh portable chargers.',
                'price' => 25.99,
                'brand' => 'Anker',
                'sku' => 'AK-A1263011',
                'weight' => 2,
                'images' => [
                    'https://placehold.co/600x600/EEE/31343C?text=Anker+PowerCore',
                ],
            ],
            [
                'title' => 'Anker Soundcore Life Q20',
                'description' => 'Hybrid Active Noise Cancelling Headphones.',
                'price' => 59.99,
                'brand' => 'Anker',
                'sku' => 'AK-A3025011',
                'weight' => 3,
                'images' => [
                    'https://placehold.co/600x600/EEE/31343C?text=Anker+Soundcore',
                ],
            ],
        ];

        foreach ($products as $productData) {
            // Check if product exists
            if (\Webkul\Product\Models\Product::where('sku', $productData['sku'])->exists()) {
                continue;
            }

            // 1. Create Base Product
            $product = $productRepository->create([
                'type' => 'simple',
                'attribute_family_id' => 1,
                'sku' => $productData['sku'],
            ]);

            \Illuminate\Database\Eloquent\Model::reguard();

            // 2. Update Product Attributes
            $productRepository->update([
                'name' => $productData['title'],
                'url_key' => Str::slug($productData['title'] . '-' . Str::random(4)),
                'short_description' => $productData['description'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'weight' => $productData['weight'],
                'status' => 1,
                'visible_individually' => 1,
                'channel' => 'default',
                'locale' => 'en',
                'inventories' => [
                    1 => 100 // default inventory source ID => qty
                ],
                'categories' => [$categoryId]
            ], $product->id);

            \Illuminate\Database\Eloquent\Model::unguard();

            // 3. Download and Attach Images
            foreach ($productData['images'] as $index => $imageUrl) {
                try {
                    $imageContents = file_get_contents($imageUrl);
                    if ($imageContents) {
                        $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                        if (!$extension) $extension = 'webp';
                        
                        $filename = uniqid() . '.' . $extension;
                        $path = 'product/' . $product->id . '/' . $filename;
                        
                        Storage::disk('public')->put($path, $imageContents);

                        DB::table('product_images')->insert([
                            'type' => 'image',
                            'path' => $path,
                            'product_id' => $product->id,
                            'position' => $index + 1
                        ]);
                    }
                } catch (\Exception $e) {
                    // Output error to console but continue seeding
                    echo "Could not download image for {$productData['sku']}: " . $e->getMessage() . "\n";
                }
            }
        }
    }
}
