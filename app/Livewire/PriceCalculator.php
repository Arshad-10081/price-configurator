<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Services\PriceCalculatorService;

class PriceCalculator extends Component
{
    
    public $products;

    public $productId;

    // Type of user (e.g., 'normal', 'company') which can affect pricing
    public $userType = 'normal';

    // Array to hold selected attribute IDs, grouped by attribute type
    public $selectedAttributes = [];

    // Resulting calculated price
    public $result = null;

    // Price calculation service instance
    protected $calculator;
    

    /**
     * Boot method to inject the price calculator service.
     * This ensures the service is available throughout the component.
     */
    public function boot(PriceCalculatorService $calculator)
    {
        $this->calculator = $calculator;
    }
    

    /**
     * Mount method runs once when the component is initialized.
     * It loads all products along with their attributes.
     */
    public function mount()
    {
        $this->products = Product::with('attributes')->get();
    }


    /**
     * Triggered when a new product is selected.
     * Automatically selects default attributes and recalculates price.
     */
    public function updatedProductId($productId)
    {

        $this->reset(['selectedAttributes', 'result']);

        if ($productId) {

          $product = Product::with('attributes')->find($productId);

          foreach ($product->attributes->groupBy('type') as $type => $attributes) {
                $this->selectedAttributes[$type] = ''; // Empty string for "Select Option"
            }
        }
        
        // Recalculate price based on new product selection
        $this->calculatePrice();
    }

    /**
     * Triggered when user type changes.
     * Recalculates price accordingly.
     */
    public function updatedUserType()
    {
        $this->calculatePrice();
    }

    /**
     * Triggered when selected attributes change.
     * Recalculates price based on updated selections.
     */
    public function updatedSelectedAttributes()
    {
        $this->calculatePrice();
    }

    /**
     * Performs the price calculation using the calculator service.
     * Only proceeds if a product and attributes are selected.
     */
    public function calculatePrice()
    {

        if ($this->productId && !empty($this->selectedAttributes)) {

            // Perform the calculation using the service
            $this->result = $this->calculator->calculate(
                $this->productId,
                $this->selectedAttributes,
                $this->userType
            );

        }
    }

    /**
     * Renders the Livewire component view.
     */
    public function render()
    {
        return view('livewire.price-calculator');
    }
}
