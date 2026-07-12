# Semicolon - Online Smartphone Store

## Overview

Semicolon is a web-based e-commerce application developed using Laravel. The system allows customers to browse and purchase smartphones online, while administrators can manage products, categories, couriers, and customer orders through an administrative dashboard.

This project was developed as a portfolio project to demonstrate practical knowledge of Laravel, MySQL, MVC architecture, authentication, database relationships, and e-commerce business processes.

---

## Features

### Customer Features

* User Registration and Authentication
* Browse Smartphone Products
* View Product Details
* Product Categories
* Shopping Cart Management
* Shipping Cost Calculation
* Checkout Process
* Payment Method Selection
* Order History
* Order Detail View
* Order Status Tracking

### Admin Features

* Admin Authentication
* Dashboard Overview
* Product Management (Create, Read, Update, Delete)
* Category Management (Create, Read, Update, Delete)
* Courier Management (Create, Read, Update, Delete)
* Order Management
* Payment Confirmation
* Shipping Confirmation
* Sales Monitoring

---

## Technology Stack

### Backend

* PHP
* Laravel
* Eloquent ORM
* MySQL

### Frontend

* Blade Template Engine
* Bootstrap
* JavaScript
* AJAX / Fetch API

### Libraries and Tools

* AdminLTE
* Font Awesome
* Chart.js

### Third-Party API

* RajaOngkir API (Shipping Cost Calculation)

---

## Database Structure

### Main Tables

* users
* categories
* products
* carts
* couriers
* orders
* order_items
* payments
* provinces
* cities

### Relationships

* User has many Orders
* Order belongs to User
* Order belongs to Courier
* Order has many Order Items
* Order Item belongs to Product
* Product belongs to Category

---

## Order Workflow

1. Customer logs in
2. Customer browses products
3. Customer adds products to cart
4. Customer calculates shipping cost
5. Customer selects payment method
6. Customer places an order
7. Admin confirms payment
8. Admin ships the order
9. Customer receives the order
10. Customer confirms order completion

---

## Installation

Clone the repository:

```bash
git clone https://github.com/KharisteasJosan988/online_smartphone_store.git
```

Install dependencies:

```bash
composer install
```


Generate application key:

```bash
php artisan key:generate
```

Configure your database credentials in the `.env` file.

Run migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

Create storage link:

```bash
php artisan storage:link
```

Start the development server:

```bash
php artisan serve
```

---

## Seeded Data

### Categories

* Android
* iOS

### Couriers

* JNE
* POS Indonesia
* TIKI

### Admin Account

Email:

```text
admin@example.com
```

Password:

```text
admin@example.com
```

### Customer Account

Email:

```text
customer@example.com
```

Password:

```text
customer@example.com
```

---

## Screenshots
<img width="1365" height="641" alt="Screenshot 2026-06-08 033231" src="https://github.com/user-attachments/assets/66273ddf-fb8b-41c4-87e3-8510441c6fb7" />
<img width="1365" height="640" alt="Screenshot 2026-06-08 033213" src="https://github.com/user-attachments/assets/e3caff56-82c1-4b17-a19f-28fc9156fa2f" />
<img width="1365" height="643" alt="Screenshot 2026-06-08 033101" src="https://github.com/user-attachments/assets/d93b0e58-6429-48aa-954e-082b2241f6e2" />
<img width="1365" height="641" alt="Screenshot 2026-06-08 033023" src="https://github.com/user-attachments/assets/9199b980-5138-44a1-8678-506465967875" />
<img width="1364" height="645" alt="Screenshot 2026-06-08 032950" src="https://github.com/user-attachments/assets/408d53c6-6cba-46bf-a0e0-8ad4842df6ef" />

---

## Future Improvements

Potential features for future development:

* Payment Proof Upload
* Automatic Stock Reduction
* Product Reviews and Ratings
* REST API Implementation

---

## Learning Objectives

This project demonstrates understanding of:

* Laravel MVC Architecture
* Authentication and Authorization
* CRUD Operations
* Database Design
* Eloquent Relationships
* Session Management
* API Integration
* AJAX Communication
* E-Commerce Business Logic

---

## Author

**Kharisteas Josan Sedi**
