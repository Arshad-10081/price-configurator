<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\DiscountRule;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $this->createProductsWithAttributes();
        $this->createDiscountRules();
    }

    protected function createProductsWithAttributes(): void
    {
        foreach ($this->getProductData() as $productData) {
            $product = Product::create([
                'name' => $productData['name'],
                'base_price' => $productData['base_price']
            ]);

            $this->createAttributesForProduct($product, $productData['attributes']);
        }
        
    }

    protected function createAttributesForProduct(Product $product, array $attributes): void
    {
        foreach ($attributes as $attribute) {
            Attribute::create([
                'product_id' => $product->id,
                'type' => $attribute['type'],
                'option' => $attribute['option'],
                'price' => $attribute['price']
            ]);
        }
    }

    protected function createDiscountRules(): void
    {
        foreach ($this->getDiscountData() as $discount) {
            DiscountRule::create([
                'type' => $discount['type'],
                'condition' => json_encode($discount['condition']),
                'discount_type' => $discount['discount_type'],
                'value' => $discount['value']
            ]);
        }
    }

    protected function getProductData(): array
    {
        return [
            [
                'name' => 'Toy Car',
                'base_price' => 100,
                'attributes' => [
                    ['type' => 'delivery', 'option' => 'At Home', 'price' => 20],
                    ['type' => 'delivery', 'option' => 'In Lab', 'price' => 0],
                    ['type' => 'speed', 'option' => 'Same Day', 'price' => 30],
                    ['type' => 'speed', 'option' => 'Next Day', 'price' => 10],
                    ['type' => 'color', 'option' => 'Red', 'price' => 5],
                    ['type' => 'color', 'option' => 'Blue', 'price' => 10],
                    ['type' => 'size', 'option' => 'Micro', 'price' => 0],
                    ['type' => 'size', 'option' => 'Mini', 'price' => 20]
                ]
            ],
            [
                'name' => 'Smart Phone',
                'base_price' => 500,
                'attributes' => [
                    ['type' => 'delivery', 'option' => 'At Home', 'price' => 20],
                    ['type' => 'delivery', 'option' => 'In Lab', 'price' => 0],
                    ['type' => 'speed', 'option' => 'Same Day', 'price' => 30],
                    ['type' => 'speed', 'option' => 'Next Day', 'price' => 10],
                    ['type' => 'color', 'option' => 'Black', 'price' => 5],
                    ['type' => 'color', 'option' => 'Blue', 'price' => 10],
                    ['type' => 'model', 'option' => 'Standard', 'price' => 0],
                    ['type' => 'model', 'option' => 'Pro', 'price' => 30],
                ]
            ],
            [
                'name' => 'Laptop',
                'base_price' => 1200,
                'attributes' => [
                    ['type' => 'delivery', 'option' => 'At Home', 'price' => 20],
                    ['type' => 'delivery', 'option' => 'In Lab', 'price' => 0],
                    ['type' => 'speed', 'option' => 'Same Day', 'price' => 30],
                    ['type' => 'speed', 'option' => 'Next Day', 'price' => 10],
                    ['type' => 'color', 'option' => 'Gray', 'price' => 5],
                    ['type' => 'color', 'option' => 'White', 'price' => 10],
                    ['type' => 'size', 'option' => '10 inch', 'price' => 0],
                    ['type' => 'size', 'option' => '14 inch', 'price' => 20]
                ]
            ],

            [
                'name' => 'Smart Watch',
                'base_price' => 2500,
                'attributes' => [
                    ['type' => 'delivery', 'option' => 'At Home', 'price' => 20],
                    ['type' => 'delivery', 'option' => 'In Lab', 'price' => 0],
                    ['type' => 'speed', 'option' => 'Same Day', 'price' => 30],
                    ['type' => 'speed', 'option' => 'Next Day', 'price' => 10],
                    ['type' => 'color', 'option' => 'Blue', 'price' => 5],
                    ['type' => 'color', 'option' => 'Green', 'price' => 10],
                    ['type' => 'model', 'option' => 'Standard', 'price' => 0],
                    ['type' => 'model', 'option' => 'Pro', 'price' => 50],
                ]
          ]
        ];
    }

    protected function getDiscountData(): array
    {
        return [
            // User type-based discounts
            [
                'type' => 'user_type',
                'condition' => ['user_type' => 'company'],
                'discount_type' => 'percentage',
                'value' => 20
            ],
            
            // Attribute-based discounts
            [
                'type' => 'attribute',
                'condition' => ['attribute_id' => 1],
                'discount_type' => 'percentage',
                'value' => 5
            ],
            [
                'type' => 'attribute',
                'condition' => ['attribute_id' => 9],
                'discount_type' => 'percentage',
                'value' => 5
            ],
            [
                'type' => 'attribute',
                'condition' => ['attribute_id' => 17],
                'discount_type' => 'percentage',
                'value' => 5
            ],
            [
                'type' => 'attribute',
                'condition' => ['attribute_id' => 25],
                'discount_type' => 'percentage',
                'value' => 5
            ],
            
            // Subtotal-based discounts
            [
                'type' => 'subtotal',
                'condition' => ['min_subtotal' => 100],
                'discount_type' => 'fixed',
                'value' => 10
            ]
        ];
    }
}