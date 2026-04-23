# Eben Supply 🛍️

> *"Street-ready gear for the culture."*
> Woodstock, Cape Town

![Laravel](https://img.shields.io/badge/Laravel-11-red)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-blue)
![PHP](https://img.shields.io/badge/PHP-8.2-purple)
![MySQL](https://img.shields.io/badge/MySQL-8-orange)

**Module:** PRT362S &nbsp;|&nbsp; **Group:** KN3 &nbsp;|&nbsp; **Institution:** CPUT

---

## 📌 About

Eben Supply is a full-stack e-commerce web application for a Cape Town-based
branded merchandise brand rooted in Woodstock's creative community. The platform
allows customers to browse, search, and purchase branded clothing and accessories
including graphic tees, caps, and tote bags.

---

## ✨ Features

### 🛒 Customer
- Browse and filter products by category (T-Shirts, Caps, Tote Bags)
- Search products by name or keyword
- View detailed product pages with size selection, stock status & size guide
- Add items to a shopping cart with quantity control
- Register, log in and manage your account
- Place orders and view full order history
- Store pickup (Woodstock) or nationwide delivery at R60 flat rate

### 🔐 Admin
- Manage products — add, edit, update stock and featured status
- View and update order statuses (Pending → Processing → Shipped → Delivered)
- Monitor inventory with low-stock alerts
- Dedicated admin dashboard

---

## 🧰 Tech Stack

| Layer       | Technology                        |
|-------------|-----------------------------------|
| Backend     | Laravel 11 (PHP 8.2)             |
| Frontend    | Blade Templates, Tailwind CSS v3 |
| JavaScript  | Alpine.js + Vanilla JS            |
| Database    | MySQL 8 (via XAMPP)               |
| Build Tool  | Vite                              |
| Auth        | Laravel Breeze                    |

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL (XAMPP recommended)

### Installation

```bash
# 1. Clone the repository
git clone <repo-url>
cd eben-supply

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Set up environment
cp .env.example .env
php artisan key:generate

# 5. Configure your database in .env
DB_DATABASE=eben_supply
DB_USERNAME=root
DB_PASSWORD=

# 6. Run migrations and seed products
php artisan migrate:fresh --seed

# 7. Build frontend assets
npm run build

# 8. Start the development server
php artisan serve
