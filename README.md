# Burger Zone - Restaurant Management & Online Food Ordering

A full-stack restaurant management system and online food ordering platform built with Laravel 11 and MySQL. Customers can browse the menu, manage a cart, and place orders online, while admins run the whole store from a dashboard: products, categories, orders, coupons, customers, and store settings.

**Live demo:** http://burgerzone.is-great.net

## Features

### Customer-facing
- Browse the menu by category
- Cart management (add, update quantity, remove)
- Checkout with customer accounts (register / login)
- Order history and order detail pages
- Order status tracking

### Admin dashboard
- Dashboard overview
- Full CRUD for categories and products
- Order management with status and payment updates
- Coupons with expiry and usage tracking
- Customer/user management with roles
- Addresses and order items management
- Store settings and admin profile
- Separate admin authentication

## Tech Stack

- **Backend:** PHP 8.2, Laravel 11 (MVC, Eloquent ORM, Blade)
- **Frontend:** Blade templates, Bootstrap 5, Tailwind CSS, Vite
- **Database:** MySQL
- **Auth:** Custom authentication with separate customer and admin middleware

## Project Structure

The Laravel application lives in the `burger-zone/` directory:

```
burger-zone/
├── app/
│   ├── Http/Controllers/   # Auth, Shop, Cart, and admin resource controllers
│   └── Models/             # Product, Category, Order, OrderItem, Coupon, Address, User, StoreSetting
├── database/               # Migrations, factories, seeders
├── resources/              # Blade views, CSS, JS
├── routes/web.php          # Public shop routes + protected admin routes
└── ...
```

## Getting Started

### Requirements
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL

### Setup

```bash
cd burger-zone

# Install PHP dependencies
composer install

# Configure the environment
cp .env.example .env
php artisan key:generate
# Edit .env and set your DB_DATABASE, DB_USERNAME, DB_PASSWORD

# Run the migrations
php artisan migrate

# Install frontend dependencies and build assets
npm install
npm run build

# Start the app
php artisan serve
```

For development with hot reloading, run `npm run dev` alongside `php artisan serve`.

The admin panel is available at `/admin/login`; customers log in at `/login`.

## Author

**Omar Abdelaziz** - [github.com/OmarAbdelaziz7](https://github.com/OmarAbdelaziz7)
