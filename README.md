# Product Price Configuration Calculator - README

## Overview
The Product Price Configuration Calculator is a dynamic product configuration system that provides real-time pricing based on selected product attributes and applicable discounts. The system is built using Laravel Livewire for seamless interactivity.

## Features
- Product selection with configurable options
- Real-time price calculation
- Multiple discount types support
- Clean, responsive interface


System Requirements
PHP 8.2

Laravel 12.x 

MySQL 5.7+ or compatible database

Composer for dependency management

Installation Instructions
Clone the repository to your local environment

Install dependencies using Composer

Configure your database connection settings

Execute the database migration command with seeding


## Installation
1. Clone repository
2. Run `composer install or composer update`
3. Setup database in `.env`
4. Generate application key: php artisan key:generate
5. Run `php artisan migrate:fresh --seed`

## Components

### Livewire Component
`PriceCalculator` - Handles all product selection and calculation logic

### Service
`PriceCalculatorService` - Contains pricing and discount calculation logic

### Models
- `Product` - Stores product information
- `Attribute` - Manages product attributes/options
- `DiscountRule` - Handles discount calculations

### Views
`price-calculator.blade.php` - Main calculator interface

## Seeding
Sample data includes:
- Multiple products with attributes
- Various discount rule types
- Ready-to-use configurations

## Usage
1. Select a product from dropdown
2. Choose desired options
3. View real-time price updates
4. See detailed price breakdown


## How to Run the Project
To run the project locally:

Start the Laravel development server:

Just type php artisan serve on your terminal
  
Open your browser and go to:
http://localhost:8000



