<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold mb-3">Product Price Calculator</h1>
                <p class="lead text-muted">Configure your product and see instant pricing</p>
            </div>

            <!-- Calculator Card -->
            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">

                    <!-- Product Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Product</label>
                        <select wire:model.live="productId" class="form-select form-select-lg">
                            <option value="">-- Choose Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    @php
                    $product = $products->firstWhere('id',$productId)
                    @endphp

                    @if ($product)
                    
                        <!-- Configuration Options -->

                        <!-- Attributes -->
                        <div class="mb-4">
                            <h4 class="fw-bold mb-3">Product Customization</h4>
                            <div class="row g-3">
                                @foreach ($product->attributes->groupBy('type') as $type => $group)
                                    <div class="col-md-6">
                                        <label class="form-label">{{ ucfirst($type) }}</label>
                                        <select wire:model.live="selectedAttributes.{{ $type }}" class="form-select">
                                        <option value="">-- Choose Option --</option>     
                                            @foreach ($group as $attr)
                                                <option value="{{ $attr->id }}">
                                                    {{ $attr->option }} (+{{ number_format($attr->price, 0) }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        
                         <!-- User Types -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">User Type</label>
                            <select wire:model.live="userType" class="form-select">
                                <option value="normal">Normal Customer</option>
                                <option value="company">Company Account</option>
                            </select>
                        </div>

                        <!-- Results -->
                        @if ($result)
                            <div class="mt-5 p-4 bg-light rounded">
                                <h4 class="fw-bold mb-4">Price Breakdown</h4>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Base Price:</td>
                                                <td class="text-end">{{ number_format($result['base_price'], 1) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Attributes Total:</td>
                                                <td class="text-end">{{ number_format($result['attribute_total'], 1) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Subtotal:</td>
                                                <td class="text-end">{{ number_format($result['subtotal'], 1) }}</td>
                                            </tr>
                                            
                                            @if(count($result['discounts']))
                                                <tr class="border-top">
                                                    <td colspan="2" class="pt-3">
                                                        <h6 class="fw-bold">Discounts Applied</h6>
                                                    </td>
                                                </tr>
                                                @foreach ($result['discounts'] as $discount)
                                                    <tr>
                                                        <td class="text-success">{{ $discount['label'] }}:</td>
                                                        <td class="text-success text-end">-{{ number_format($discount['amount'], 1) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            
                                            <tr class="border-top fw-bold fs-5">
                                                <td class="pt-3">Final Price:</td>
                                                <td class="text-end pt-3 text-primary">{{ number_format($result['final'], 1) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif


                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <i class="bi bi-box-seam fs-1 text-muted"></i>
                            <h5 class="mt-3">No product selected</h5>
                            <p class="text-muted">Please select a product to see configuration options</p>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>