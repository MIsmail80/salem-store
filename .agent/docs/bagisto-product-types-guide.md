# Bagisto Product Types - Complete Guide

> A comprehensive guide covering all product types available in Bagisto 2.3.0 with step-by-step instructions for creating and managing each type.

---

## Table of Contents

1. [Simple Product](#1-simple-product)
2. [Configurable Product](#2-configurable-product)
3. [Virtual Product](#3-virtual-product)
4. [Downloadable Product](#4-downloadable-product)
5. [Bundle Product](#5-bundle-product)
6. [Grouped Product](#6-grouped-product)
7. [Booking Product](#7-booking-product)
   - [Default Booking](#71-default-booking)
   - [Appointment Booking](#72-appointment-booking)
   - [Event Booking](#73-event-booking)
   - [Rental Booking](#74-rental-booking)
   - [Table Booking](#75-table-booking)

---

## 1. Simple Product

### Overview

A **Simple Product** is the most basic product type in Bagisto. It represents a single, physical item with no variations (no size, color, or other options). Simple products are ideal for items that are sold as-is without customization.

### Use Cases

- Electronic devices (single model)
- Books
- Basic accessories
- Food items
- Single-unit products

### Step-by-Step Creation

#### Step 1: Navigate to Products

1. Go to **Catalog >> Products**
2. Click **Add Product**
3. Select **Simple** under Product Type
4. Select the **Attribute Family**
5. Enter the **SKU** (Stock Keeping Unit) - must be unique
6. Click **Save Product**

#### Step 2: General Attributes

| Field | Description | Required |
|-------|-------------|----------|
| **Name** | Product display name | ✅ Yes |
| **URL Key** | URL-friendly slug (e.g., `philips-speaker`) | ✅ Yes |
| **Tax Category** | Select applicable tax category from dropdown | ❌ No |

#### Step 3: Settings (Toggle Buttons)

| Setting | Description |
|---------|-------------|
| **New** | Feature product in "New Products" section |
| **Featured** | Show in "Featured Products" section |
| **Visible Individually** | Make product visible on storefront |
| **Status** | Enable/disable product in store |
| **Guest Checkout** | Allow guest customers to purchase |

#### Step 4: Description

- **Short Description**: Brief feature summary (appears in listings)
- **Description**: Detailed product information (appears on product page)

#### Step 5: Meta Description (SEO)

| Field | Purpose |
|-------|---------|
| **Meta Title** | Page title for search engines |
| **Meta Keyword** | Keywords for SEO optimization |
| **Meta Description** | Description shown in search results |

#### Step 6: Images

- Click **Add Images** to upload product photos
- Multiple images supported
- First image becomes the main product image

#### Step 7: Price

| Field | Description |
|-------|-------------|
| **Price** | Regular selling price |
| **Cost** | Product cost (for internal tracking) |
| **Special Price** | Discounted price |
| **Special Price From/To** | Date range for special pricing |

#### Step 8: Shipping

| Field | Description |
|-------|-------------|
| **Width** | Product width |
| **Height** | Product height |
| **Depth** | Product depth |
| **Weight** | Product weight (for shipping calculation) |

#### Step 9: Inventories

- Set the **Quantity** available in stock
- Default is `0` (shows as "Out of Stock")

#### Step 10: Save

Click **Save Product** to publish.

---

## 2. Configurable Product

### Overview

A **Configurable Product** is a parent product that contains variations (child products) based on configurable attributes like size, color, or material. Customers select their preferred option from dropdown menus.

### Use Cases

- Clothing (different sizes and colors)
- Shoes (size variations)
- Electronics (storage capacity, color)
- Furniture (fabric, size options)

### Prerequisites

Before creating a configurable product, ensure you have:
1. Created configurable attributes (e.g., Color, Size) with:
   - `Use for Configurable Product` = Yes
   - Attribute type = Select/Dropdown

### Step-by-Step Creation

#### Step 1: Create Parent Product

1. Go to **Catalog >> Products**
2. Click **Add Product**
3. Select **Configurable** under Product Type
4. Select **Attribute Family**
5. Enter **SKU**
6. Click **Save Product**

#### Step 2: Select Configurable Attributes

After saving, you'll see a selection screen for:
- **Color** options
- **Size** options
- Any other configurable attributes in your family

Select the values that will create variations.

#### Step 3: General Attributes

Same as Simple Product:
- Name, URL Key, Tax Category
- Toggle settings (New, Featured, Visible, Status, Guest Checkout)

#### Step 4: Description & Meta

Same as Simple Product configuration.

#### Step 5: Images

Add images for the parent product. Individual variations can have their own images.

#### Step 6: Variations

The system automatically creates child variations based on selected attributes:

| Variation | SKU | Price | Quantity |
|-----------|-----|-------|----------|
| Red - Small | SKU-RED-S | $50 | 100 |
| Red - Medium | SKU-RED-M | $50 | 80 |
| Blue - Small | SKU-BLUE-S | $55 | 50 |

For each variation, configure:
- **SKU** (auto-generated, can be customized)
- **Price**
- **Quantity**
- **Images** (optional per-variant images)
- **Status** (enable/disable individual variants)

#### Step 7: Save

Click **Save Product** to publish all variations.

### Frontend Behavior

Customers see dropdown menus to select their options. Price and availability update dynamically based on selection.

---

## 3. Virtual Product

### Overview

A **Virtual Product** is a non-physical item that doesn't require shipping. It's tracked in inventory but delivered digitally or as a service.

### Use Cases

- Memberships
- Subscriptions
- Online services
- Warranties
- Digital services (not downloadable files)
- Gift cards

### Key Differences from Simple Product

| Feature | Simple | Virtual |
|---------|--------|---------|
| Physical shipping | ✅ Yes | ❌ No |
| Shipping options shown | ✅ Yes | ❌ No |
| Inventory tracking | ✅ Yes | ✅ Yes |
| Weight/Dimensions | ✅ Required | ❌ Not needed |

### Step-by-Step Creation

#### Step 1: Navigate to Products

1. Go to **Catalog >> Products**
2. Click **Add Product**
3. Select **Virtual** under Product Type
4. Select **Attribute Family**
5. Enter **SKU**
6. Click **Save Product**

#### Step 2: General Settings

| Field | Description |
|-------|-------------|
| **Name** | Product name (e.g., "Gym Membership - 1 Year") |
| **URL Key** | URL slug (e.g., `gym-membership-annual`) |
| **Tax Category** | Select applicable tax |

#### Step 3: Settings (Toggle Buttons)

Same as Simple Product:
- New, Featured, Visible Individually, Status, Guest Checkout

#### Step 4: Description & Meta

Configure Short Description, Description, and all Meta fields for SEO.

#### Step 5: Images

Upload product images even for virtual products to improve presentation.

#### Step 6: Inventory

Set the quantity available. For unlimited virtual products, set a high number.

#### Step 7: Price

Configure Price, Cost, Special Price, and date ranges as needed.

#### Step 8: Save

Click **Save Product** to publish.

### Checkout Behavior

- No shipping address required
- No shipping method selection
- Immediate order completion possible

---

## 4. Downloadable Product

### Overview

A **Downloadable Product** is a digital product that customers can download after purchase. Bagisto manages the file distribution and can limit download attempts.

### Use Cases

- E-books (PDF, EPUB)
- Software applications
- Music files (MP3, FLAC)
- Video content
- Digital art/graphics
- Templates and documents
- Stock photos

### Step-by-Step Creation

#### Step 1: Create Product

1. Go to **Catalog >> Products**
2. Select **Downloadable** under Product Type
3. Select **Attribute Family**
4. Enter **SKU**
5. Click **Save Product**

#### Step 2: General Settings

| Field | Description |
|-------|-------------|
| **Name** | Product name (e.g., "Learning Laravel E-Book") |
| **URL Key** | URL slug (e.g., `learning-laravel-ebook`) |
| **Tax Category** | Select digital goods tax rate |

#### Step 3: Settings (Toggle Buttons)

Same as other products:
- New, Featured, Visible Individually, Status

> **Note**: Guest Checkout may not be available for downloadable products as customers need an account to access downloads.

#### Step 4: Description & Meta

Configure all description and SEO fields.

#### Step 5: Price

Set the price for the downloadable product. No shipping-related costs apply.

#### Step 6: Images

Upload product preview images.

#### Step 7: Downloadable Information

This is the unique section for downloadable products:

| Field | Description |
|-------|-------------|
| **Name** | Display name for the download link |
| **Price** | Price for this specific download (for multiple files) |
| **File** | The actual downloadable file |
| - Upload File | Upload from your computer |
| - Insert URL | External URL to the file |
| **Sample** | Free preview file or URL |
| **Downloads Allowed** | Maximum download attempts (0 = unlimited) |

#### Step 8: Samples Section

Provide free samples to customers:
- **Title**: Sample name
- **File**: Upload or URL for the sample file

Samples are accessible without purchase.

#### Step 9: Save

Click **Save Product** to publish.

### Customer Experience

1. Customer purchases product
2. After payment, download links appear in:
   - Order confirmation page
   - Order details in customer account
   - Order confirmation email

---

## 5. Bundle Product

### Overview

A **Bundle Product** groups multiple products together, allowing customers to customize their selection from predefined options. The final price is calculated based on chosen items.

### Use Cases

- Computer bundles (choose processor, RAM, storage)
- Gift sets (select items to include)
- Meal combos (choose main, side, drink)
- Custom kits (build your own)
- Sports equipment sets

### Key Features

- Customers choose from multiple options
- Flexible pricing based on selections
- Required and optional items
- Multiple input types (dropdown, radio, checkbox, multi-select)

### Step-by-Step Creation

#### Step 1: Create Product

1. Go to **Catalog >> Products**
2. Select **Bundle** under Product Type
3. Select **Attribute Family**
4. Enter **SKU**
5. Click **Save Product**

#### Step 2: General Settings

| Field | Description |
|-------|-------------|
| **Name** | Bundle name (e.g., "Custom Gaming PC") |
| **URL Key** | URL slug |
| **Tax Category** | Bundle tax category |

#### Step 3: Settings (Toggle Buttons)

- New, Featured, Visible Individually, Status, Guest Checkout

#### Step 4: Description & Meta

Configure all standard description and SEO fields.

#### Step 5: Images

Upload bundle product images.

#### Step 6: Bundle Items

This is the key section for bundles:

Click **Add Option** to create a bundle option:

| Field | Description |
|-------|-------------|
| **Option Title** | Display name (e.g., "Choose Processor") |
| **Input Type** | How customers select: |
| | - **Select**: Single choice dropdown |
| | - **Radio**: Single choice radio buttons |
| | - **Checkbox**: Multiple choices allowed |
| | - **Multi-Select**: Multiple choices from list |
| **Required** | Is this selection mandatory? |

For each option, add products:
1. Use **Search Product** to find products
2. Add products to the option
3. Set **Quantity** for each item
4. Set **Sort Order** for display

#### Example Bundle Configuration

```
Bundle: Custom PC Build

Option 1: Processor (Required, Radio)
├── Intel i5 - Qty: 1
├── Intel i7 - Qty: 1
└── Intel i9 - Qty: 1

Option 2: RAM (Required, Select)
├── 8GB DDR4 - Qty: 1
├── 16GB DDR4 - Qty: 1
└── 32GB DDR4 - Qty: 1

Option 3: Storage (Required, Checkbox)
├── 256GB SSD - Qty: 1
├── 512GB SSD - Qty: 1
└── 1TB HDD - Qty: 1

Option 4: Accessories (Optional, Multi-Select)
├── Mouse - Qty: 1
├── Keyboard - Qty: 1
└── Monitor - Qty: 1
```

#### Step 7: Save

Click **Save Product** to publish.

### Pricing Behavior

- Bundle shows price range (From $X to $Y)
- Final price calculated from selected items
- Quantity can be adjusted at cart level (not individual items)

---

## 6. Grouped Product

### Overview

A **Grouped Product** displays multiple related simple products together on a single page. Customers can add any combination of the grouped products to their cart.

### Use Cases

- Product families (same product, different sizes sold separately)
- Related item sets (shirt, pants, tie)
- Complementary products
- Multi-pack options
- Replacement parts

### Key Differences: Bundle vs Grouped

| Feature | Bundle | Grouped |
|---------|--------|---------|
| Customer selects | From predefined options | Any quantity of each item |
| Pricing | Combined based on selection | Individual product prices |
| Cart display | Single bundled item | Separate items |
| Inventory | From child products | From child products |

### Step-by-Step Creation

#### Step 1: Create Product

1. Go to **Catalog >> Products**
2. Select **Grouped** under Product Type
3. Select **Attribute Family**
4. Enter **SKU**
5. Click **Save Product**

#### Step 2: General Settings

| Field | Description |
|-------|-------------|
| **Name** | Group name (e.g., "Men's Casual Wear Set") |
| **URL Key** | URL slug |
| **Tax Category** | Select tax category |

#### Step 3: Settings (Toggle Buttons)

- New, Featured, Visible Individually, Status, Guest Checkout

#### Step 4: Description & Meta

Configure all standard fields.

#### Step 5: Images

Upload images representing the grouped products together.

#### Step 6: Grouped Products

This is where you add products to the group:

1. Use **Search Products** to find simple products
2. Add products to the group
3. For each product, configure:
   - **Default Quantity**: Pre-filled quantity in cart
   - **Sort Order**: Display order on frontend

#### Example Grouped Product

```
Grouped Product: Men's Office Essentials

Products:
├── Dress Shirt (White) - Default Qty: 1 - $45
├── Formal Pants (Black) - Default Qty: 1 - $60
├── Leather Belt - Default Qty: 1 - $25
└── Silk Tie - Default Qty: 1 - $30
```

#### Step 7: Save

Click **Save Product** to publish.

### Frontend Behavior

- All products displayed with individual pricing
- Customers adjust quantity for each product
- Selected items added as separate cart items
- Each product maintains its own inventory

---

## 7. Booking Product

### Overview

**Booking Products** allow customers to book time-based services or resources. Bagisto supports five booking types, each designed for specific use cases.

### Sub-Types

1. **Default Booking** - General time slots
2. **Appointment Booking** - Service appointments
3. **Event Booking** - Ticketed events
4. **Rental Booking** - Equipment/property rentals
5. **Table Booking** - Restaurant reservations

---

### 7.1 Default Booking

#### Overview

Default booking handles general time-slot based products with two modes:
- **Many Bookings for One Day**: Multiple slots per day
- **One Booking for Many Days**: Book a range of days

#### Use Cases

- Conference room booking
- Equipment reservation
- Facility access
- General time-based services

#### Step-by-Step Creation

1. Go to **Catalog >> Products**
2. Select **Booking** under Product Type
3. Enter SKU and Save Product

#### Booking Configuration

| Field | Description |
|-------|-------------|
| **Booking Type** | Select "Default" |
| **Location** | Physical address of booking |
| **Quantity** | Available slots per time period |
| **Available From** | Start date for availability |
| **Available To** | End date for availability |
| **Type** | Many Bookings for One Day / One Booking for Many Days |
| **Slot Duration (Mins)** | Length of each slot (default: 45) |
| **Break Time (Mins)** | Time between slots (default: 15) |

#### Adding Slots (Many Bookings for One Day)

1. Click **Add** icon
2. Select day of week
3. Set **From Time** and **To Time**
4. Set **Status** (enabled/disabled)
5. Repeat for each day

#### Adding Slots (One Booking for Many Days)

| Field | Description |
|-------|-------------|
| **From Day** | Starting day |
| **To Day** | Ending day |
| **From Time** | Daily start time |
| **To Time** | Daily end time |

---

### 7.2 Appointment Booking

#### Overview

Designed for service-based businesses where customers book specific appointment slots.

#### Use Cases

- Doctor/dental appointments
- Salon services
- Consulting sessions
- Personal training
- Legal consultations

#### Configuration Fields

| Field | Description |
|-------|-------------|
| **Booking Type** | Select "Appointment" |
| **Location** | Service location |
| **Quantity** | Number of parallel appointments |
| **Available Every Week** | Yes: Weekly recurring / No: Date range |
| **Slot Duration (Mins)** | Appointment length |
| **Break Time (Mins)** | Buffer between appointments |
| **Same Slot All Days** | Yes: Uniform schedule / No: Per-day schedule |

#### Slot Configuration

**Same Slot All Days = Yes:**
- Set single From Time and To Time for all days

**Same Slot All Days = No:**
- Configure separate times for each day of the week
- Allows different hours for weekdays vs weekends

---

### 7.3 Event Booking

#### Overview

For ticketed events with multiple ticket types and limited capacity.

#### Use Cases

- Concerts
- Conferences
- Workshops
- Sporting events
- Theater performances

#### Configuration Fields

| Field | Description |
|-------|-------------|
| **Booking Type** | Select "Event" |
| **Location** | Event venue |
| **Available From** | Event start date/time |
| **Available To** | Event end date/time |

#### Ticket Configuration

Add multiple ticket types:

| Field | Description |
|-------|-------------|
| **Ticket Name** | E.g., "VIP", "General", "Student" |
| **Quantity** | Available tickets of this type |
| **Price** | Price per ticket |
| **Description** | What's included |

#### Example

```
Event: Tech Conference 2025

Tickets:
├── Early Bird - $99 - 100 available
├── General Admission - $149 - 500 available
├── VIP Access - $299 - 50 available
└── Student - $49 - 100 available
```

---

### 7.4 Rental Booking

#### Overview

For renting equipment, vehicles, or property on an hourly or daily basis.

#### Use Cases

- Car/bike rentals
- Camera equipment
- Power tools
- Vacation properties
- Party supplies

#### Configuration Fields

| Field | Description |
|-------|-------------|
| **Booking Type** | Select "Rental" |
| **Location** | Pickup location |
| **Quantity** | Items available for rent |
| **Available Every Week** | Recurring weekly schedule |

#### Renting Type Options

**A) Daily Basis**
- Set **Price Per Day**
- Customer selects date range

**B) Hourly Basis**
- Set **Price Per Hour**
- Configure available time slots
- Same Slot All Days or per-day configuration

**C) Both (Daily and Hourly)**
- Set both daily and hourly prices
- Customer chooses rental type at checkout
- Configure slot times for hourly rentals

---

### 7.5 Table Booking

#### Overview

Specifically designed for restaurant table reservations.

#### Use Cases

- Restaurant reservations
- Café bookings
- Bar seating
- Private dining rooms

#### Configuration Fields

| Field | Description |
|-------|-------------|
| **Booking Type** | Select "Table" |
| **Location** | Restaurant address |
| **Available Every Week** | Yes: Weekly / No: Date range |
| **Charged Per** | "Table" or "Guest" |
| **Guest Limit Per Table** | Max guests (if charging per table) |
| **Guest Capacity** | Maximum party size |
| **Slot Duration (Mins)** | Reservation length |
| **Break Time (Mins)** | Turnaround time |
| **Prevent Scheduling Before** | Advance booking lead time |
| **Same Slot All Days** | Uniform or per-day schedule |

#### Pricing Models

**Per Table:**
- Fixed price regardless of party size
- Up to Guest Limit guests included

**Per Guest:**
- Price multiplied by number of guests
- More flexible for various party sizes

---

### Booking Administration

#### Admin Panel Access

1. Go to **Sales >> Booking Products**
2. View all booking orders in datagrid

#### Calendar View

- Click **Calendar** button
- Visual representation of all bookings
- See busy/available slots at a glance
- Filter by product or date range

---

## Quick Reference Matrix

| Product Type | Physical | Shipping | Inventory | Variations | Special Features |
|--------------|----------|----------|-----------|------------|------------------|
| Simple | ✅ | ✅ | ✅ | ❌ | Basic product |
| Configurable | ✅ | ✅ | ✅ | ✅ | Size/Color options |
| Virtual | ❌ | ❌ | ✅ | ❌ | Services |
| Downloadable | ❌ | ❌ | ❌ | ❌ | Digital files |
| Bundle | ✅ | ✅ | Via children | ✅ | Custom combos |
| Grouped | ✅ | ✅ | Via children | ❌ | Multi-add |
| Booking | ❌ | ❌ | Time-based | ✅ | Reservations |

---

## Common Fields Across All Products

### Required for All Products

- **SKU** (Stock Keeping Unit)
- **Name**
- **URL Key**

### Recommended for All Products

- **Short Description**
- **Description**
- **Meta Title**
- **Meta Keywords**
- **Meta Description**
- **Images**

### Toggle Settings (Available for Most)

- **New** - Feature in New Products section
- **Featured** - Feature in Featured Products section
- **Visible Individually** - Show on storefront
- **Status** - Enable/disable product
- **Guest Checkout** - Allow guest purchases

---

## Best Practices

### Naming Conventions

- Use descriptive, SEO-friendly names
- Include key specifications in name
- Keep URL keys short and relevant

### Images

- Use high-quality images (min 1000x1000px)
- Include multiple angles
- Show product in use
- Maintain consistent style

### Descriptions

- Lead with benefits
- Include specifications
- Use bullet points for features
- Add size/compatibility information

### SEO

- Unique meta titles per product
- Include primary keywords
- Write compelling meta descriptions
- Keep meta descriptions under 160 characters

### Inventory

- Set accurate quantities
- Configure low-stock alerts
- Enable backorders when appropriate
- Regular inventory audits

---

## Technical Reference

### Product Type Classes

Located in `Webkul\Product\Type\`:

| Type | Class |
|------|-------|
| Simple | `Simple.php` |
| Configurable | `Configurable.php` |
| Virtual | `Virtual.php` |
| Downloadable | `Downloadable.php` |
| Bundle | `Bundle.php` |
| Grouped | `Grouped.php` |
| Booking | `Booking.php` |

All extend `AbstractType.php` which provides:
- Price indexing
- Cart preparation
- Stockability checks
- Quantity validation

### Creating Custom Product Types

To create a custom product type:

1. Create a new package
2. Define configuration in `Config/product_types.php`:

```php
<?php

return [
    'custom_product' => [
        'key'   => 'custom_product',
        'name'  => 'CustomProduct',
        'class' => 'Webkul\\CustomProduct\\Type\\CustomProduct',
        'sort'  => 7
    ],
];
```

3. Create the type class extending `AbstractType`
4. Register the service provider

---

## Resources

- [Bagisto Official Documentation](https://docs.bagisto.com)
- [Bagisto GitHub Repository](https://github.com/bagisto/bagisto)
- [Bagisto Community Forums](https://forums.bagisto.com)

---

*Last Updated: January 2026*  
*Bagisto Version: 2.3.0*
