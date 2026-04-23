# Eben Supply — Online Merchandise Store

**CPUT PRT362S | Group KN3**

Eben Supply is a Woodstock, Cape Town-based branded merchandise retail store.
This project delivers a full-stack e-commerce web application enabling online
product browsing, cart management, simulated checkout (PayFast/Ozow), and
order tracking — with a complete admin dashboard for order and inventory management.

---

## Team Members

| Name | Student Number |
|---|---|
| _(Add team member 1)_ | _(Student No.)_ |
| _(Add team member 2)_ | _(Student No.)_ |
| _(Add team member 3)_ | _(Student No.)_ |

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 11 (PHP 8.3), MVC, Eloquent ORM |
| Frontend | Blade Templates + Tailwind CSS v3 |
| Database | MySQL 8 |
| Authentication | Laravel Breeze (session-based) |
| Payments | Simulated PayFast/Ozow (demo only) |
| File Storage | Laravel Storage (local dev) |
| Build Tool | Vite |
| Dev Environment | XAMPP / MySQL 8 + PHP |

---

## Local Setup

### Prerequisites
- PHP 8.2+  (`php -v`)
- Composer 2+ (`composer -v`)
- Node.js 18+ (`node -v`)
- MySQL 8+ running locally
- Git

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/your-org/eben-supply.git
cd eben-supply

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies & build assets
npm install && npm run build

# 4. Set up environment
cp .env.example .env
php artisan key:generate

# 5. Configure database in .env
# Edit DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 6. Create database (MySQL)
mysql -u root -p -e "CREATE DATABASE eben_supply CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 7. Run migrations
php artisan migrate

# 8. Seed demo data
php artisan db:seed

# 9. Create storage symlink
php artisan storage:link

# 10. Start dev server
php artisan serve
```

Visit: **http://localhost:8000**

---

## Admin Credentials

| Role | Email | Password |
|---|---|---|
| Admin | admin@ebensupply.co.za | password |
| Customer | customer@test.co.za | password |

Admin dashboard: **http://localhost:8000/admin**

---

## Feature Checklist

- [x] **FR01** — Product Catalogue (grid, category filter, stock indicator)
- [x] **FR01** — Product Detail page (image, description, size selector, add-to-cart)
- [x] **FR02** — Shopping Cart (add / update / remove, DB-persisted for logged-in users, session for guests)
- [x] **FR03** — Checkout (contact info, pickup vs delivery, conditional address fields)
- [x] **FR04** — Simulated PayFast/Ozow payment screen → order confirmation
- [x] **FR05** — Authentication (register, login, logout, role-based middleware)
- [x] **FR06** — Admin Dashboard (summary cards: orders, pending, products, low-stock alerts)
- [x] **FR06** — Admin Product Management (create, edit, delete/soft-delete, toggle featured, image upload)
- [x] **FR06** — Admin Order Management (list, filter by status, update status, view detail)
- [x] **FR07** — Customer Order Tracking (`/my-orders`, status timeline badge)
- [x] **FR08** — Admin Inventory Management (inline stock editor per product/size, low-stock highlight)

---

## Route Map

```
GET  /                         Homepage (featured products + hero)
GET  /products                 Product catalogue
GET  /products/{id}            Product detail
GET  /cart                     Cart page
POST /cart/add                 Add item to cart
POST /cart/update              Update cart quantity
POST /cart/remove              Remove cart item
GET  /checkout                 Checkout form (auth)
POST /checkout                 Process checkout (auth)
GET  /checkout/payment         Simulated payment page (auth)
POST /checkout/payment         Confirm payment (auth)
GET  /order/confirmation       Order success page (auth)
GET  /my-orders                Order history (auth)
GET  /my-orders/{id}           Order detail (auth)
GET  /admin                    Admin dashboard
GET  /admin/products           Product list
GET  /admin/products/create    Create product form
GET  /admin/products/{id}/edit Edit product form
GET  /admin/orders             Order list (filterable)
GET  /admin/orders/{id}        Order detail + status update
GET  /admin/inventory          Inline stock editor
```

---

## Database Schema

| Table | Purpose |
|---|---|
| `users` | Customers and admins (role enum) |
| `products` | Merchandise catalogue (soft-deletes) |
| `product_sizes` | Per-size stock quantities (S/M/L/XL/XXL) |
| `orders` | Customer orders (status + fulfillment) |
| `order_items` | Line items per order |
| `cart_items` | Persistent cart (user_id or session_id) |

---

## Known Limitations

- **Payments are fully simulated** — no real PayFast/Ozow API integration. No real money is processed.
- **No live courier integration** — delivery is flat-rate R60, no real tracking number issued.
- **Email notifications not implemented** — order confirmation is on-screen only.
- **No guest checkout** — users must register/login before placing an order.
- **Image storage is local** — for production, swap `FILESYSTEM_DISK=local` to `s3`.

---

## Deployment Notes

### Render (recommended)
1. Push repo to GitHub
2. Create a new **Web Service** on Render, select PHP buildpack
3. Add environment variables from `.env.example`
4. Add a **MySQL** add-on or use PlanetScale
5. Set `APP_ENV=production`, `APP_DEBUG=false`
6. Build command: `composer install --no-dev && npm ci && npm run build && php artisan migrate --force && php artisan db:seed --force`

### InfinityFree / shared hosting
1. Upload `/public` contents to `public_html`
2. Edit `public/index.php` to point to correct paths
3. Import database dump via phpMyAdmin
4. Set `.env` values via hosting control panel

---

## Project Structure

```
eben-supply/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── ProductController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── OrderController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── ProductController.php
│   │   │       ├── OrderController.php
│   │   │       └── InventoryController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php, Product.php, ProductSize.php
│       ├── Order.php, OrderItem.php, CartItem.php
├── database/
│   ├── migrations/           (8 migration files)
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       └── ProductSeeder.php
├── resources/views/
│   ├── layouts/app.blade.php, admin.blade.php
│   ├── home.blade.php
│   ├── products/, cart/, checkout/, orders/
│   └── admin/ (dashboard, products, orders, inventory)
├── public/images/products/   (product images)
├── routes/web.php
├── .env.example
└── README.md
```

---

*CPUT PRT362S — Eben Supply E-Commerce Platform | Group KN3*
