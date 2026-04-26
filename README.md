# Medicine Manager

A complete, modern PHP & MySQL-based Point of Sale (POS) and Inventory Management system designed specifically for pharmacies and medical halls. It features a beautiful premium glassmorphism UI, real-time search, automated PDF billing, and advanced stock tracking.

<img align="center" alt="Makpay Home_page" width="auto" height="auto" src="https://github.com/muzammilkarimi/medicine-manager/blob/master/img/Screenshot%202024-03-06%20014614.png?raw=true" />

## 🚀 Key Features

### 🛒 Modern POS Billing System
* **Lightning-fast Keyboard Navigation:** Fully optimized for keyboard use. Use the Arrow Keys to navigate autocomplete suggestions and press Enter to instantly jump between fields and add items to the cart.
* **Live Autocomplete Search:** Instantly fetches medicine details, prices, and available stock from the database as you type.
* **Native PDF Invoices:** Generates beautiful, colorful, perfectly-scaled A4 Tax Invoices using native browser printing. No clunky external libraries required.

### 📦 Inventory Management
* **Full CRUD Operations:** Add, Edit, and Delete medicines with a smooth, premium user interface.
* **Live Search:** Quickly locate specific stock items from the database in real-time.

### 🚨 Smart Alerts & Tracking
* **Empty Soon:** Track low stock items with a custom unit threshold filter (e.g., < 5, 10, 20, 50 units).
* **Expire Soon:** Track expiring medicines with a custom duration filter (e.g., within 7, 15, 30, 90 days). Automatically highlights already expired items in **Red** and upcoming expiring items in **Yellow**.

### 🛡️ Data Security & Maintenance
* **1-Click Database Backup:** Automatically generates and downloads a complete `.sql` backup file of your entire database directly from the dashboard.
* **Security:** All new database interactions use Prepared Statements to completely prevent SQL Injection attacks.

### ✨ Premium UI/UX
* Sleek frosted-glass (glassmorphism) design elements.
* Single-screen fixed background layout to prevent messy full-page scrolling.
* Interactive hover animations and active focus states for input fields.

## 🛠️ Technology Stack
* **Frontend:** HTML5, Vanilla CSS, JavaScript (jQuery for AJAX)
* **Backend:** PHP
* **Database:** MySQL
