# 🏍️ MR. VIKING — Premium Motorcycle E-Commerce Platform

> **University Project Defense Package**
>
> A full-stack e-commerce and community platform for premium Italian motorcycles,
> built with PHP, MySQL, and vanilla JavaScript.

---

## 📋 Table of Contents

1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [System Architecture](#system-architecture)
4. [Directory Structure](#directory-structure)
5. [Database Schema](#database-schema)
6. [Feature Catalogue](#feature-catalogue)
7. [Installation & Setup](#installation--setup)
8. [API Reference](#api-reference)
9. [Security Implementation](#security-implementation)
10. [Screenshots](#screenshots)
11. [Future Roadmap](#future-roadmap)
12. [Acknowledgements](#acknowledgements)

---

## Project Overview

MR. VIKING is a premium motorcycle e-commerce website that showcases Italian
engineering excellence through a curated catalog of 27 motorcycles spanning
7 families. The platform integrates a full-featured community forum, secure
user authentication, and a complete shopping cart / checkout workflow.

### Key Metrics

| Metric | Value |
|--------|-------|
| Total Motorcycles | 27 (18 MR. VIKING + 9 Honda) |
| Motorcycle Families | 7 (Brutale, Dragster, Enduro Veloce, F3, Rush, Superveloce, Turismo Veloce) |
| Database Tables | 9 |
| PHP API Endpoints | 20+ |
| JavaScript Modules | 12 |
| CSS Files | 4 |
| Reaction Types | 7 (Like, Love, Care, Haha, Wow, Sad, Angry) |

---

## Technology Stack

### Backend
| Technology | Purpose |
|------------|---------|
| **PHP 7.4+** | Server-side scripting, REST API, session management |
| **MySQL / MariaDB** | Relational database with PDO abstraction layer |
| **Google OAuth 2.0** | Third-party authentication via Google Sign-In |

### Frontend
| Technology | Purpose |
|------------|---------|
| **HTML5** | Semantic markup with accessibility attributes |
| **CSS3** | Custom properties design system, glassmorphism, animations |
| **Vanilla JavaScript (ES6+)** | Modular architecture, no framework dependencies |

### Key Libraries & Fonts
- **Google Fonts**: Inter (300–900), Playfair Display (italic 400/700)
- **cURL** (PHP): Google OAuth token exchange

---

## System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                      CLIENT BROWSER                         │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌────────────┐ │
│  │ index.php│  │ cart.html│  │community │  │model-detail│ │
│  │          │  │          │  │  .html   │  │   .html    │ │
│  └────┬─────┘  └────┬─────┘  └────┬─────┘  └─────┬──────┘ │
│       │             │             │              │         │
│  ┌────┴─────────────┴─────────────┴──────────────┴──────┐  │
│  │              JavaScript Modules (ES6)                 │  │
│  │  script.js │ bikes.js │ community.js │ features.js   │  │
│  │  cursor.js │ model-detail.js                         │  │
│  └──────────────────────┬───────────────────────────────┘  │
└─────────────────────────┼──────────────────────────────────┘
                          │ HTTP (fetch / XHR)
┌─────────────────────────┼──────────────────────────────────┐
│                    PHP API LAYER                            │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────────┐  │
│  │  api.php     │  │auth_handler  │  │ community_api    │  │
│  │  (Products,  │  │  .php        │  │   .php           │  │
│  │   Orders)    │  │ (Auth, Users)│  │ (Posts,Reactions)│  │
│  └──────┬───────┘  └──────┬───────┘  └────────┬─────────┘  │
│         │                 │                   │            │
│  ┌──────┴─────────────────┴───────────────────┴──────────┐ │
│  │               PDO Database Abstraction                │ │
│  └──────────────────────┬────────────────────────────────┘ │
└─────────────────────────┼──────────────────────────────────┘
                          │
┌─────────────────────────┼──────────────────────────────────┐
│                  MySQL DATABASE                             │
│  ┌────────┐ ┌──────────┐ ┌───────────┐ ┌───────────────┐  │
│  │ users  │ │ products │ │  orders   │ │community_posts│  │
│  └────────┘ └──────────┘ └───────────┘ └───────────────┘  │
│  ┌──────────────┐ ┌──────────────┐ ┌───────────────────┐   │
│  │order_items   │ │post_reactions│ │ post_comments     │   │
│  └──────────────┘ └──────────────┘ └───────────────────┘   │
│  ┌──────────────┐ ┌──────────────┐                         │
│  │ news_posts   │ │login_attempts│                         │
│  └──────────────┘ └──────────────┘                         │
└─────────────────────────────────────────────────────────────┘
```

### Design Patterns Used

| Pattern | Location | Description |
|---------|----------|-------------|
| **Module Pattern** | [`script.js`](js/script.js) | All JS features encapsulated in self-contained objects (Preloader, Header, Auth, MegaMenu, etc.) |
| **RESTful API** | [`api.php`](includes/api.php), [`auth_handler.php`](includes/auth_handler.php), [`community_api.php`](includes/community_api.php) | Action-based routing with JSON responses |
| **Singleton (DB)** | All PHP files | `getDB()` returns a single PDO connection per request |
| **Observer** | [`script.js`](js/script.js) | `IntersectionObserver` for scroll-reveal animations |
| **Factory** | [`script.js`](js/script.js) | `TextScramble` class instantiated for hero text effects |
| **Strategy** | [`cursor.js`](js/cursor.js) | `CursorManager` selects between `Glossy3DCursor` and `Windows11SmoothCursor` based on page |

---

## Directory Structure

```
project/
├── README.md                  ← You are here
├── database.sql               ← Full schema + 27-product seed
├── index.php                  ← Landing page (entry point)
│
├── admin/                     ← Admin dashboard
│   └── admin.php              ← Product/order/user management
│
├── user/                      ← User-facing pages
│   ├── profile.php            ← Profile, orders, password tabs
│   ├── cart.html              ← Shopping cart with checkout
│   ├── community.html         ← Community forum feed
│   ├── motorcycles.html       ← Full motorcycle catalog
│   ├── model-detail.html      ← Single motorcycle detail view
│   ├── compare.html           ← Side-by-side comparison
│   ├── about-us.html          ← Brand story & heritage
│   └── calculator.html        ← EMI / loan calculator
│
├── includes/                  ← PHP backend APIs
│   ├── api.php                ← Products CRUD + order placement
│   ├── auth_handler.php       ← Auth (signup, login, OTP, OAuth, password reset)
│   └── community_api.php      ← Community posts, reactions, comments
│
├── css/                       ← Stylesheets
│   ├── styles.css             ← Main design system (3,665 lines)
│   ├── community.css          ← Community page glassmorphism
│   ├── mega-menu.css          ← Mega dropdown navigation
│   └── model-detail.css       ← Product detail page
│
├── js/                        ← Client-side JavaScript
│   ├── script.js              ← Core modules (Preloader, Header, Auth, MegaMenu, HeroSlider, etc.)
│   ├── bikes.js               ← 27 motorcycle data entries
│   ├── community.js           ← Community feed, posts, reactions, comments
│   ├── features.js            ← Cart, wishlist, compare (FeatureManager)
│   ├── cursor.js              ← Dual cursor system (Glossy3D + Windows 11)
│   └── model-detail.js        ← Product detail page interactivity
│
├── images/                    ← Image assets
│   ├── MR. VIKING - About Us - MR. VIKING/
│   │   ├── All Bikes/         ← 27 motorcycle thumbnails
│   │   └── Fornt sectio 3/    ← Hero section images
│   ├── MR. VIKING - MR. VIKING - Motorcycle Shop - Italian Motorcycle/
│   ├── Posts/                 ← Community post images
│   └── uploads/               ← User-uploaded content
│       ├── avatars/           ← Profile pictures
│       └── posts/             ← Community post media
│
├── screenshots/               ← Project defense screenshots
├── assets/                    ← Static assets (fonts, icons)
└── uploads/                   ← Upload directory (writeable)
```

---

## Database Schema

### Entity Relationship Diagram

```
users ──1:N──→ orders ──1:N──→ order_items ──N:1──→ products
  │
  └──1:N──→ community_posts ──1:N──→ post_reactions
                  │
                  └──1:N──→ post_comments (self-referencing via parent_id)
```

### Table Summary

| Table | Rows | Purpose |
|-------|------|---------|
| `users` | Dynamic | Registered users with role-based access |
| `products` | 27 (seeded) | Motorcycle catalog |
| `orders` | Dynamic | Customer purchase orders |
| `order_items` | Dynamic | Line items per order |
| `news_posts` | Dynamic | Admin blog/news articles |
| `login_attempts` | Dynamic | Brute-force protection log |
| `community_posts` | Dynamic | User-generated content |
| `post_reactions` | Dynamic | 7-type reaction tracking |
| `post_comments` | Dynamic | Nested comment threads |

### Key Design Decisions

- **`users.contact`** serves as both email and phone login identifier
- **First registered user** is automatically assigned `is_admin = 1`
- **`orders.status`** uses ENUM for data integrity: `Pending → Approved → Delivered` (or `Rejected`)
- **`community_posts`** uses `fake_likes`, `fake_comments`, `fake_shares` for seeding high-engagement metrics
- **`post_comments.parent_id`** enables nested/threaded comments
- **`post_reactions`** has a UNIQUE constraint on `(post_id, user_id)` — one reaction per user per post

---

## Feature Catalogue

### 1. Authentication & Authorization
- **Email/Phone Signup** with OTP verification (6-digit code, 15-minute expiry)
- **Password Login** with bcrypt hashing
- **Google OAuth 2.0** sign-in (token exchange via cURL)
- **Facebook** social auth flow (UI complete)
- **Password Reset** via token-based email flow
- **Role-Based Access**: `is_admin` flag controls admin panel access
- **Brute-Force Protection**: `login_attempts` table tracks failed attempts
- **Session Management**: PHP sessions with HttpOnly, Secure flags

### 2. Product Catalog
- **27 Motorcycles** across 7 families
- **Mega Menu Navigation**: Family → Variant → Preview with specs
- **Accordion Display**: Expandable family panels on homepage
- **Product Grid**: Filterable catalog on motorcycles page
- **Model Detail Page**: Hero, design, specs (4 tabs), configurator, related models, CTA
- **Product Comparison**: Side-by-side spec comparison (up to 3 bikes)
- **Search**: Real-time product search with suggestions

### 3. Shopping Cart & Checkout
- **localStorage Cart**: Persists across sessions
- **Quantity Controls**: Increment/decrement/remove
- **Cart Summary**: Subtotal, delivery fee, total calculation
- **Checkout Modal**: Name, phone, address collection
- **Order Placement**: Server-side transaction via [`api.php`](includes/api.php)
- **Order History**: User-specific order listing in profile

### 4. Community Forum
- **Post Types**: News, Reviews, User Posts
- **7 Reactions**: Like, Love, Care, Haha, Wow, Sad, Angry
- **Nested Comments**: Threaded replies via `parent_id`
- **Post Options**: Delete, Archive, Pin (admin)
- **Image Upload**: Media attachment for posts
- **Bike Reviews**: Star rating system linked to product catalog
- **Sorting**: Latest / Popular
- **Filtering**: By post type (All, News, Reviews, User Posts)

### 5. User Profile
- **Profile Management**: Edit name, nickname, phone, address
- **Avatar Upload**: Profile picture with preview
- **Password Change**: Current password verification
- **Order History**: Tabular view of past orders

### 6. Admin Dashboard
- **Stats Overview**: Total products, orders, users
- **Product Management**: Add, edit, delete products
- **Order Management**: View all orders, update status (Approve/Reject/Deliver)
- **User Management**: List, edit, delete users; promote to admin

### 7. UI/UX Features
- **Preloader**: Animated loading screen
- **Dual Cursor System**: Glossy 3D cursor (homepage) / Windows 11 smooth cursor (global)
- **Hero Slider**: 5-slide autoplay carousel
- **Scroll Reveal**: IntersectionObserver-based animations
- **Parallax Effects**: Mouse-driven parallax on hero elements
- **Counter Animation**: Animated stat counters (bikes sold, customers, etc.)
- **Smooth Scroll**: Anchor link navigation
- **Newsletter Signup**: Email collection form
- **Mobile Menu**: Fullscreen overlay navigation
- **Glassmorphism**: Frosted-glass UI elements throughout
- **Dark Theme**: #0a0a0a base with red (#c00000) accent

---

## Installation & Setup

### Prerequisites
- **PHP 7.4+** with `pdo_mysql`, `curl`, `gd`, `fileinfo` extensions
- **MySQL 5.7+** or **MariaDB 10.3+**
- **Web Server**: Apache with `mod_rewrite` (or PHP built-in server)

### Quick Start

```bash
# 1. Clone / extract the project
cd Mr_Viking_Project

# 2. Start MySQL (XAMPP / WAMP / standalone)
#    Ensure MySQL is running on localhost:3306

# 3. Import the database
mysql -u root < database.sql

# 4. Start the PHP development server
php -S localhost:8000

# 5. Open in browser
#    http://localhost:8000
```

### Database Configuration

All PHP files use the following default credentials (modify in each file if needed):

```php
$dbHost = 'localhost';
$dbName = 'MrViking_db';
$dbUser = 'root';
$dbPass = '';
```

### Google OAuth Setup (Optional)

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create OAuth 2.0 credentials
3. Update in [`auth_handler.php`](includes/auth_handler.php):
   ```php
   $google_client_id = 'YOUR_CLIENT_ID';
   $google_client_secret = 'YOUR_CLIENT_SECRET';
   $google_redirect_uri = 'http://localhost:8000/auth_handler.php?action=googleCallback';
   ```

### Directory Permissions

Ensure these directories are writeable by the web server:

```bash
chmod 777 images/uploads/avatars/
chmod 777 images/uploads/posts/
chmod 777 uploads/
```

---

## API Reference

### Products API ([`api.php`](includes/api.php))

| Action | Method | Auth | Description |
|--------|--------|------|-------------|
| `getProducts` | GET | Public | Fetch all products |
| `addProduct` | POST | Admin | Create new product |
| `editProduct` | POST | Admin | Update existing product |
| `deleteProduct` | POST | Admin | Remove product |
| `placeOrder` | POST | Public | Submit order (transactional) |
| `getOrders` | GET | Admin | List all orders |
| `updateOrderStatus` | POST | Admin | Change order status |

### Auth API ([`auth_handler.php`](includes/auth_handler.php))

| Action | Method | Auth | Description |
|--------|--------|------|-------------|
| `signup` | POST | Public | Register new user (OTP sent) |
| `login` | POST | Public | Authenticate user |
| `verify_otp` | POST | Public | Verify 6-digit OTP |
| `resend_otp` | POST | Public | Resend verification code |
| `verify_2fa` | POST | Session | Two-factor verification |
| `logout` | POST | Session | Destroy session |
| `forgot_password` | POST | Public | Request password reset |
| `reset_password` | POST | Public | Set new password via token |
| `updateProfile` | POST | Session | Edit user profile |
| `changePassword` | POST | Session | Change password |
| `getUserOrders` | POST | Session | Fetch user's order history |
| `listUsers` | POST | Admin | List all users |
| `deleteUser` | POST | Admin | Remove user |
| `updateUser` | POST | Admin | Edit user details |
| `makeAdmin` | POST | Admin | Promote user to admin |
| `social_login` | POST | Public | Google/Facebook auth |
| `googleLogin` | GET | Public | Initiate Google OAuth flow |
| `googleCallback` | GET | Public | Google OAuth redirect handler |

### Community API ([`community_api.php`](includes/community_api.php))

| Action | Method | Auth | Description |
|--------|--------|------|-------------|
| `fetchPosts` | GET | Public | Get posts with reactions & comments |
| `createPost` | POST | Session | Create new post (with media upload) |
| `toggleReaction` | POST | Session | Add/remove/change reaction |
| `addComment` | POST | Session | Add comment (supports nested replies) |
| `getBikeRatings` | GET | Public | Aggregate bike review ratings |
| `deletePost` | POST | Session/Owner | Delete own post |
| `archivePost` | POST | Session/Owner | Archive own post |
| `cleanupPosts` | POST | Admin | Remove orphaned posts |
| `pinPost` | POST | Admin | Pin/unpin post to top of feed |

---

## Security Implementation

| Measure | Implementation |
|---------|---------------|
| **Password Hashing** | `password_hash()` with `PASSWORD_DEFAULT` (bcrypt) |
| **Session Security** | `session.cookie_httponly`, `session.use_only_cookies`, `session.cookie_secure` (HTTPS) |
| **OTP Verification** | 6-digit code, 15-minute expiry, stored in DB |
| **Brute-Force Protection** | `login_attempts` table tracks failed attempts per IP/contact |
| **SQL Injection Prevention** | PDO prepared statements with parameterized queries throughout |
| **XSS Prevention** | `htmlspecialchars()` / `escapeHtml()` on user-generated content |
| **CSRF** | Session-based state validation for OAuth flows |
| **Role-Based Access** | Server-side `isAdmin()` check on all admin endpoints |
| **File Upload Validation** | Extension checking, unique filenames (`uniqid()`) |
| **Google OAuth** | Authorization code flow with server-side token exchange |

---

## Screenshots

> *Add screenshots of the running application in the [`screenshots/`](screenshots/) directory:*
>
> - `01-homepage.png` — Landing page with hero slider
> - `02-mega-menu.png` — Motorcycle navigation mega menu
> - `03-product-detail.png` — Model detail page
> - `04-cart.png` — Shopping cart
> - `05-community.png` — Community forum
> - `06-admin.png` — Admin dashboard
> - `07-compare.png` — Product comparison
> - `08-auth.png` — Authentication modal
> - `09-profile.png` — User profile
> - `10-mobile.png` — Mobile responsive view

---

## Future Roadmap

- [ ] **Payment Gateway Integration**: bKash, Nagad, SSLCommerz (Bangladesh)
- [ ] **Email Service**: PHPMailer for OTP, password reset, order confirmations
- [ ] **Wishlist Persistence**: Server-side wishlist synced with localStorage
- [ ] **PWA Support**: Service worker for offline capability
- [ ] **Real-time Notifications**: WebSocket-based notification system
- [ ] **Advanced Search**: Full-text search with filters (price range, brand, family)
- [ ] **Inventory Management**: Stock tracking with low-stock alerts
- [ ] **Order Tracking**: Multi-step order status with timeline
- [ ] **Multi-language**: Bengali (বাংলা) + English localization
- [ ] **Unit Tests**: PHPUnit for API endpoints, Jest for JS modules

---

## Acknowledgements

- **Motorcycle Data & Imagery**: Inspired by MV Agusta Motor S.p.A. and Honda Motor Co., Ltd.
- **Fonts**: Inter by Rasmus Andersson, Playfair Display by Claus Eggers Sørensen
- **Icons**: Custom SVG icons throughout
- **University**: Project submitted for academic defense purposes

---

> **Built with passion for Italian engineering excellence.**
> 🇮🇹 🏍️

---

*© 2025–2026 MR. VIKING. All rights reserved. This is an academic project.*