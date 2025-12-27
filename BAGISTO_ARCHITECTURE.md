# Bagisto E-Commerce Platform Architecture Analysis

This document provides a comprehensive architectural analysis of the Bagisto e-commerce platform based on the project structure at `c:\projects\salem-store`.

---

## Executive Summary

Bagisto is a **modular Laravel e-commerce platform** built with 33 separate packages under `packages/Webkul/`. It follows enterprise patterns including Repository Pattern, Service Container, Event-Driven Architecture, and a sophisticated theming system.

> [!IMPORTANT]
> Before making any code changes, understand that Bagisto uses a package-based architecture. Direct modifications to core packages will be overwritten during upgrades.

---

## Architecture Overview

```
┌─────────────────────────────────────────────────────────────────────────┐
│                           BAGISTO ARCHITECTURE                          │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│   ┌─────────────┐   ┌─────────────┐                                    │
│   │    Shop     │   │    Admin    │   ← UI Layers (Routes, Views)      │
│   │  (Frontend) │   │   (Backend) │                                    │
│   └──────┬──────┘   └──────┬──────┘                                    │
│          │                 │                                            │
│          ▼                 ▼                                            │
│   ┌─────────────────────────────────────────────────────────────┐      │
│   │                      THEME LAYER                             │      │
│   │  (ViewRenderEventManager, ThemeViewFinder, Themes.php)      │      │
│   └──────────────────────────┬──────────────────────────────────┘      │
│                              │                                          │
│   ┌──────────────────────────▼──────────────────────────────────┐      │
│   │                 BUSINESS LOGIC PACKAGES                      │      │
│   │  ┌─────────┐ ┌─────────┐ ┌───────────┐ ┌───────────────┐   │      │
│   │  │ Product │ │Checkout │ │   Sales   │ │   Customer    │   │      │
│   │  └────┬────┘ └────┬────┘ └─────┬─────┘ └───────┬───────┘   │      │
│   │       │           │            │               │            │      │
│   │       └───────────┴────────────┴───────────────┘            │      │
│   │                          │                                   │      │
│   │   ┌──────────────────────▼──────────────────────────────┐   │      │
│   │   │                  CORE PACKAGE                        │   │      │
│   │   │  (Core.php, SystemConfig, Facades, Repositories)    │   │      │
│   │   └─────────────────────────────────────────────────────┘   │      │
│   └─────────────────────────────────────────────────────────────┘      │
│                              │                                          │
│   ┌──────────────────────────▼──────────────────────────────────┐      │
│   │                    DATA LAYER                                │      │
│   │     Models → Contracts → Repositories → Database            │      │
│   └─────────────────────────────────────────────────────────────┘      │
│                                                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

---

## Package Organization

### 33 Packages Under `packages/Webkul/`

| Package | Purpose | Key Components |
|---------|---------|----------------|
| **Core** | Foundation services, utilities, facades | `Core.php`, channels, currencies, locales |
| **Admin** | Admin panel UI, controllers, views | DataGrids, 90+ HTTP controllers |
| **Shop** | Storefront UI, customer-facing routes | Blade components, checkout flow |
| **Product** | Product management, types, attributes | ProductRepository, Type classes |
| **Checkout** | Cart, checkout process | `Cart.php` facade (1177 lines) |
| **Sales** | Orders, invoices, shipments, refunds | Order lifecycle management |
| **Customer** | Customer accounts, addresses, wishlist | Authentication, profiles |
| **Attribute** | Product attributes system | EAV-style implementation |
| **Category** | Category tree management | Nested set structure |
| **Inventory** | Stock management | Inventory sources |
| **Tax** | Tax calculations | Tax categories, rates |
| **Shipping** | Shipping methods | Rate calculation |
| **Payment** | Payment methods | Payment gateway abstraction |
| **Paypal** | PayPal integration | PayPal SDK wrapper |
| **CartRule** | Cart-level promotions | Coupon codes, discounts |
| **CatalogRule** | Catalog-level pricing rules | Scheduled price rules |
| **Marketing** | SEO, campaigns, email marketing | URL rewrites, search synonyms |
| **CMS** | Content management | Pages, blocks |
| **Theme** | Theming system | View paths, Vite assets |
| **DataGrid** | Admin data tables | Filterable, sortable grids |
| **DataTransfer** | Import/Export | CSV, file handling |
| **User** | Admin users | Roles, permissions |
| **Notification** | System notifications | Push notifications |
| **Sitemap** | XML sitemaps | SEO optimization |
| **Rule** | Rule engine base | Condition evaluation |
| **SocialLogin** | OAuth providers | Google, Facebook, etc. |
| **SocialShare** | Social sharing | Share buttons |
| **GDPR** | GDPR compliance | Data requests |
| **FPC** | Full Page Cache | Response caching |
| **BookingProduct** | Booking products | Appointments, events |
| **MagicAI** | AI features | OpenAI integration |
| **Installer** | Installation wizard | Setup process |
| **DebugBar** | Development tools | Debugging |

---

## Package Internal Structure

Each package follows a consistent Laravel package structure:

```
packages/Webkul/[PackageName]/
├── composer.json              # Package definition & autoloading
└── src/
    ├── Config/               # Package configuration
    ├── Console/              # Artisan commands
    ├── Contracts/            # Interfaces for models
    ├── Database/
    │   ├── Factories/        # Model factories
    │   ├── Migrations/       # Database migrations
    │   └── Seeders/          # Data seeders
    ├── Facades/              # Laravel facades
    ├── Helpers/              # Helper classes
    ├── Http/
    │   ├── Controllers/      # Route controllers
    │   ├── Middleware/       # HTTP middleware
    │   └── Requests/         # Form requests
    ├── Jobs/                 # Queue jobs
    ├── Listeners/            # Event listeners
    ├── Mail/                 # Mailable classes
    ├── Models/               # Eloquent models
    ├── Observers/            # Model observers
    ├── Providers/            # Service providers
    ├── Repositories/         # Repository classes
    ├── Resources/
    │   ├── assets/          # CSS, JS, images
    │   ├── lang/            # Translation files
    │   └── views/           # Blade templates
    ├── Routes/               # Route definitions
    └── Type/                 # (Product only) Product types
```

---

## Core Components Deep Dive

### 1. Core Package (`packages/Webkul/Core`)

The **foundation of the entire platform**, providing:

#### Core.php Service Class
Located at [Core.php](file:///c:/projects/salem-store/packages/Webkul/Core/src/Core.php)

```php
// Manages channels, locales, currencies
core()->getCurrentChannel();
core()->getCurrentLocale();
core()->getCurrentCurrency();
core()->formatPrice($amount);
core()->getConfigData('key.path');
```

#### Key Facades
- `Core` → [Core.php](file:///c:/projects/salem-store/packages/Webkul/Core/src/Facades/Core.php)
- `SystemConfig` → System configuration management
- `Menu` → Admin menu management
- `Acl` → Access control lists
- `ElasticSearch` → Search integration

### 2. Theme System (`packages/Webkul/Theme`)

#### View Path Resolution
Located at [Themes.php](file:///c:/projects/salem-store/packages/Webkul/Theme/src/Themes.php)

```
Request → Theme Middleware → Themes::set() → Config view.paths → Blade Rendering
```

#### Theme Configuration
Located at [themes.php](file:///c:/projects/salem-store/config/themes.php)

```php
'shop' => [
    'default' => [
        'name'        => 'Default',
        'assets_path' => 'public/themes/shop/default',
        'views_path'  => 'resources/themes/default/views',
        'vite'        => [...],
    ],
],
```

#### ViewRenderEventManager
Located at [ViewRenderEventManager.php](file:///c:/projects/salem-store/packages/Webkul/Theme/src/ViewRenderEventManager.php)

Provides **extension points** for injecting content into views:

```php
Event::listen('bagisto.shop.layout.body.after', function ($viewRenderEventManager) {
    $viewRenderEventManager->addTemplate('your::template');
});
```

### 3. Repository Pattern

All data access uses the Repository Pattern with base class from `prettus/l5-repository`:

```php
// Example: ProductRepository
class ProductRepository extends Repository
{
    public function model(): string
    {
        return Product::class;  // Contract interface
    }
}
```

#### Contracts (Interfaces)
Each model has a corresponding contract interface allowing for easy substitution:

```
packages/Webkul/Product/src/Contracts/Product.php  → Interface
packages/Webkul/Product/src/Models/Product.php     → Implementation
```

---

## Request Lifecycle

```
┌───────────────────────────────────────────────────────────────────────────┐
│                        REQUEST LIFECYCLE IN BAGISTO                        │
├───────────────────────────────────────────────────────────────────────────┤
│                                                                           │
│  1. HTTP Request                                                          │
│       │                                                                   │
│       ▼                                                                   │
│  2. Laravel Router (routes/web.php, api.php)                              │
│       │   ↓ Loads package routes                                          │
│       │   packages/Webkul/Shop/src/Routes/web.php                         │
│       │   packages/Webkul/Admin/src/Routes/web.php                        │
│       │                                                                   │
│       ▼                                                                   │
│  3. Middleware Stack                                                      │
│       │   - 'web', 'shop', PreventRequestsDuringMaintenance               │
│       │   - Theme::class (sets active theme & view paths)                 │
│       │   - Locale::class (sets current locale)                           │
│       │   - Currency::class (sets current currency)                       │
│       │                                                                   │
│       ▼                                                                   │
│  4. Controller                                                            │
│       │   - Injects repositories via constructor                          │
│       │   - Business logic orchestration                                  │
│       │                                                                   │
│       ▼                                                                   │
│  5. Repository Layer                                                      │
│       │   - Data access via contracts                                     │
│       │   - Eloquent models                                               │
│       │                                                                   │
│       ▼                                                                   │
│  6. View Rendering                                                        │
│       │   - Theme views_path checked first                                │
│       │   - ViewRenderEventManager fires events                           │
│       │   - Blade components rendered                                     │
│       │                                                                   │
│       ▼                                                                   │
│  7. HTTP Response                                                         │
│                                                                           │
└───────────────────────────────────────────────────────────────────────────┘
```

---

## Event System

### Event-Driven Architecture

Bagisto uses Laravel's event system extensively for loose coupling between packages.

#### Key Events

| Event | Package | Purpose |
|-------|---------|---------|
| `checkout.cart.add.before/after` | Checkout | Cart item added |
| `checkout.order.save.after` | Sales | Order placed |
| `sales.order.cancel.after` | Sales | Order cancelled |
| `sales.invoice.save.after` | Sales | Invoice created |
| `sales.shipment.save.after` | Sales | Shipment created |
| `customer.registration.after` | Customer | Customer registered |
| `bagisto.shop.layout.body.after` | Theme | Inject into layout |

#### EventServiceProvider Example
Located at [EventServiceProvider.php](file:///c:/projects/salem-store/packages/Webkul/Shop/src/Providers/EventServiceProvider.php)

```php
protected $listen = [
    'checkout.order.save.after' => [
        [Order::class, 'afterCreated'],
    ],
    'customer.registration.after' => [
        [Customer::class, 'afterCreated'],
    ],
];
```

---

## Data Flow Between Modules

```
┌────────────────────────────────────────────────────────────────────────┐
│                      E-COMMERCE DATA FLOW                              │
├────────────────────────────────────────────────────────────────────────┤
│                                                                        │
│   CUSTOMER                        PRODUCT                              │
│      │                               │                                 │
│      │ browses                       │                                 │
│      ▼                               ▼                                 │
│   ┌──────────┐  adds to cart   ┌──────────┐                           │
│   │   Shop   │ ───────────────▶│ Checkout │                           │
│   │ Package  │                 │  Cart.php│                           │
│   └──────────┘                 └────┬─────┘                           │
│                                     │                                  │
│                              ┌──────▼──────┐                          │
│                              │   Shipping  │                          │
│                              │   Package   │                          │
│                              └──────┬──────┘                          │
│                                     │                                  │
│                              ┌──────▼──────┐                          │
│                              │   Payment   │                          │
│                              │   Package   │                          │
│                              └──────┬──────┘                          │
│                                     │                                  │
│                              ┌──────▼──────┐                          │
│                              │    Sales    │ ──▶ Order                │
│                              │   Package   │ ──▶ Invoice              │
│                              └──────┬──────┘ ──▶ Shipment             │
│                                     │        ──▶ Refund               │
│                                     │                                  │
│                              ┌──────▼──────┐                          │
│                              │  Inventory  │                          │
│                              │   Package   │                          │
│                              └─────────────┘                          │
│                                                                        │
│   Cross-Cutting: CartRule, CatalogRule, Tax, Marketing                │
│                                                                        │
└────────────────────────────────────────────────────────────────────────┘
```

---

## Extension Points & Safe Customization

### ✅ SAFE to Customize

| Method | Location | Example |
|--------|----------|---------|
| **Event Listeners** | Custom package or `app/Listeners` | Extend order processing |
| **Custom Themes** | `resources/themes/your-theme/` | Override any view |
| **View Events** | Via `ViewRenderEventManager` | Inject content into layouts |
| **Custom Packages** | `packages/YourVendor/YourPackage/` | New modules |
| **Override Views** | Theme's `views_path` | Template customization |
| **Config Publishing** | `config/themes.php` etc. | Configuration changes |
| **Blade Components** | Custom theme components | UI extensions |

### Creating a Custom Package (Recommended Approach)

```
packages/
└── YourVendor/
    └── YourPackage/
        ├── composer.json
        └── src/
            ├── Providers/
            │   └── YourPackageServiceProvider.php
            ├── Http/Controllers/
            ├── Models/
            └── Resources/views/
```

```php
// composer.json
{
    "name": "yourvendor/your-package",
    "autoload": {
        "psr-4": {
            "YourVendor\\YourPackage\\": "src/"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "YourVendor\\YourPackage\\Providers\\YourPackageServiceProvider"
            ]
        }
    }
}
```

### ⚠️ AVOID Modifying Directly

> [!CAUTION]
> The following areas should NOT be modified directly as they will be overwritten during Bagisto upgrades:

| Area | Path | Alternative |
|------|------|-------------|
| Core Package | `packages/Webkul/Core/` | Create custom package |
| Product Package | `packages/Webkul/Product/` | Use events/observers |
| Database Migrations | `packages/*/Database/Migrations/` | Add new migrations |
| Vendor Files | `vendor/` | Never modify |

---

## Admin Panel Architecture

### Route Organization
Located at [Admin Routes](file:///c:/projects/salem-store/packages/Webkul/Admin/src/Routes/)

```
Routes/
├── web.php              # Main routes file
├── auth-routes.php      # Login, logout
├── catalog-routes.php   # Products, categories, attributes
├── sales-routes.php     # Orders, invoices, shipments
├── customers-routes.php # Customer management
├── marketing-routes.php # Promotions, campaigns
├── settings-routes.php  # Configuration
└── cms-routes.php       # CMS pages
```

### Controller Organization
Located at [Admin Controllers](file:///c:/projects/salem-store/packages/Webkul/Admin/src/Http/Controllers/)

```
Controllers/
├── Catalog/           # Products, Categories, Attributes
│   ├── ProductController.php
│   ├── CategoryController.php
│   └── AttributeController.php
├── Sales/             # Order management
├── Customers/         # Customer management
├── Marketing/         # Promotions
├── Settings/          # Configuration
└── User/              # Admin users
```

### DataGrid System

Admin uses a DataGrid package for filterable, sortable tables:

```php
// Example DataGrid
class ProductDataGrid extends DataGrid
{
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('products')
            ->addSelect('id', 'sku', 'type')
            ->where('parent_id', null);
        return $queryBuilder;
    }
    
    public function prepareColumns()
    {
        $this->addColumn([
            'index'  => 'id',
            'label'  => 'ID',
            'type'   => 'number',
        ]);
    }
}
```

---

## Shop Frontend Architecture

### Route Organization
Located at [Shop Routes](file:///c:/projects/salem-store/packages/Webkul/Shop/src/Routes/)

```
Routes/
├── web.php              # Includes other route files
├── store-front-routes.php  # Home, product pages, cart
├── customer-routes.php     # Account, orders, addresses
├── checkout-routes.php     # Checkout process
└── api.php                  # AJAX endpoints
```

### Blade Components
Located at `packages/Webkul/Shop/src/Resources/views/components/`

Shop uses anonymous Blade components for reusable UI elements:

```php
// ShopServiceProvider.php
Blade::anonymousComponentPath(__DIR__.'/../Resources/views/components', 'shop');

// Usage in blade
<x-shop::layouts.header />
<x-shop::products.card :product="$product" />
```

### Theme Override System

Views are resolved in this order:
1. Custom theme: `resources/themes/your-theme/views/`
2. Default theme: `resources/themes/default/views/`
3. Package views: `packages/Webkul/Shop/src/Resources/views/`

---

## Product Type System

Located at `packages/Webkul/Product/src/Type/`

Bagisto supports multiple product types via the Strategy Pattern:

| Type | Class | Capabilities |
|------|-------|--------------|
| Simple | `Simple.php` | Basic product |
| Configurable | `Configurable.php` | Variants with options |
| Virtual | `Virtual.php` | Non-physical products |
| Bundle | `Bundle.php` | Product bundles |
| Grouped | `Grouped.php` | Grouped products |
| Downloadable | `Downloadable.php` | Digital products |
| Booking | (BookingProduct package) | Appointments |

```php
// Get product type instance
$typeInstance = $product->getTypeInstance();
$typeInstance->prepareForCart($data);
$typeInstance->getPrice();
```

---

## Key Files Reference

| Purpose | File Path |
|---------|-----------|
| Root composer.json | [composer.json](file:///c:/projects/salem-store/composer.json) |
| Core Service | [Core.php](file:///c:/projects/salem-store/packages/Webkul/Core/src/Core.php) |
| Cart Facade | [Cart.php](file:///c:/projects/salem-store/packages/Webkul/Checkout/src/Cart.php) |
| Theme Manager | [Themes.php](file:///c:/projects/salem-store/packages/Webkul/Theme/src/Themes.php) |
| Product Repository | [ProductRepository.php](file:///c:/projects/salem-store/packages/Webkul/Product/src/Repositories/ProductRepository.php) |
| Shop Provider | [ShopServiceProvider.php](file:///c:/projects/salem-store/packages/Webkul/Shop/src/Providers/ShopServiceProvider.php) |
| Admin Provider | [AdminServiceProvider.php](file:///c:/projects/salem-store/packages/Webkul/Admin/src/Providers/AdminServiceProvider.php) |
| Theme Config | [themes.php](file:///c:/projects/salem-store/config/themes.php) |

---

## Development Guidelines

### Best Practices

1. **Use Events for Extension**
   ```php
   Event::listen('checkout.order.save.after', function ($order) {
       // Your custom logic
   });
   ```

2. **Create Custom Packages for New Features**
   - Keep your code separate from core packages
   - Register via Service Provider
   - Use proper namespacing

3. **Override Views via Themes**
   - Copy view file to your theme directory
   - Maintain same relative path
   
4. **Use Repositories for Data Access**
   - Inject repositories via constructor
   - Never query models directly in controllers

5. **Follow Bagisto Conventions**
   - Check sibling files for patterns
   - Use existing Blade components

### Development Workflow

```
1. Analyze existing package structure
2. Create custom package OR use events
3. Register any new service providers
4. Run: php artisan config:cache
5. Run: php artisan view:cache
6. Test thoroughly
```

---

## Next Steps

> [!NOTE]
> This analysis is complete. I am ready to help you with specific features or modifications. Please provide your instructions and I will propose the cleanest architectural solution following Bagisto best practices.

**Common Next Tasks:**
- Create a custom theme
- Add a new product attribute
- Integrate a payment gateway
- Add custom checkout step
- Create admin dashboard widget
- Extend product functionality
