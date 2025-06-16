<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PriceCalculator;

// PriceCalculator Component
Route::get('/', PriceCalculator::class);
