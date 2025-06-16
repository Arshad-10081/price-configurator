<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\DiscountRule;

class PriceCalculatorService
{
    /**
     * Calculate product price with attributes and applicable discounts.
     */
    public function calculate($productId, array $attributeIds, string $userType): array
    {
    
        $product = Product::with('attributes')->findOrFail($productId);
        $basePrice = $product->base_price;
        $attributeTotal = Attribute::whereIn('id', $attributeIds)->sum('price');
        $subtotal = $basePrice + $attributeTotal;

        $discounts = DiscountRule::all();
        
            // Initialize with base + attributes total
            $currentAmount = $subtotal;

            $appliedDiscounts = [];

            foreach ($discounts as $rule) {
                
                $condition = $rule->condition;

                $applies = match($rule->type) {
                    'attribute' => in_array($condition['attribute_id'], $attributeIds),
                    'subtotal'  => $currentAmount >= $condition['min_subtotal'], // Use current amount
                    'user_type' => $condition['user_type'] === $userType,
                    default => false
                };

                if ($applies) {
                    $amount = $rule->discount_type === 'percentage'
                        ? ($currentAmount * $rule->value / 100) // Calculate % on current amount
                        : $rule->value;

                    $currentAmount -= $amount; // Discount amount minus to currentAmount

                    $appliedDiscounts[] = [
                        'label' => ucfirst($rule->type) . ' Discount',
                        'amount' => $amount,
                    ];
                    
                }
            }

        return [
            'base_price' => $basePrice,
            'attribute_total' => $attributeTotal,
            'subtotal' => $subtotal,
            'discounts' => $appliedDiscounts,
            'final' => max($currentAmount, 0) // Ensure price doesn't go negative}
        ];
    }
}

