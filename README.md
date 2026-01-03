# E-Commerce Website with Laravel 12 & Livewire

A modern, full-featured e-commerce website built with Laravel 12 and Livewire starter kit.

## Features

- 🛍️ **Product Catalog**: Browse products with search, filtering, and sorting
- 🛒 **Shopping Cart**: Add products to cart with quantity management
- 💳 **Checkout System**: Complete order placement with shipping information
- 👤 **User Authentication**: Login and registration system
- 📦 **Order Management**: Track orders with order numbers
- 🎨 **Admin Panel**: Manage products, categories, and inventory
- 🎯 **Modern UI**: Beautiful, responsive design with Tailwind CSS
- ⚡ **Livewire Components**: Real-time updates without page refreshes

## Tech Stack

- **Laravel 12**: PHP web framework
- **Livewire 3**: Full-stack framework for Laravel
- **Tailwind CSS**: Utility-first CSS framework
- **SQLite**: Database (can be changed to MySQL/PostgreSQL)

## Installation

1. **Clone or navigate to the project directory:**
   ```bash
   cd ecommerce-app
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Set up environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database in `.env`:**
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

5. **Run migrations:**
   ```bash
   php artisan migrate
   ```

6. **Seed the database with sample data:**
   ```bash
   php artisan db:seed
   ```

7. **Start the development server:**
   ```bash
   php artisan serve
   ```

8. **Visit the application:**
   Open your browser and navigate to `http://localhost:8000`

## Default Credentials

After seeding, you can create a new user account through the registration page, or use:
- **Email**: test@example.com
- **Password**: (create a new account or use the factory default)

## Project Structure

### Models
- `Product`: Product catalog with categories, pricing, and inventory
- `Category`: Product categories
- `CartItem`: Shopping cart items
- `Order`: Customer orders
- `OrderItem`: Order line items

### Livewire Components
- `ProductList`: Product listing with search and filters
- `ProductDetail`: Individual product details
- `ShoppingCart`: Shopping cart management
- `Checkout`: Order checkout process
- `AdminProducts`: Admin product management

### Routes
- `/` - Home page (Product listing)
- `/product/{slug}` - Product detail page
- `/cart` - Shopping cart (requires authentication)
- `/checkout` - Checkout page (requires authentication)
- `/admin/products` - Admin product management (requires authentication)
- `/login` - Login page
- `/register` - Registration page

## Features in Detail

### Product Management
- View all products with pagination
- Search products by name or description
- Filter by category
- Sort by price, name, or latest
- View product details
- Add products to cart

### Shopping Cart
- Add/remove items
- Update quantities
- View cart total
- Proceed to checkout

### Checkout Process
- Enter shipping information
- Review order summary
- Place order
- Receive order confirmation

### Admin Panel
- Create, edit, and delete products
- Manage product categories
- Update inventory
- Set product status (active/inactive)
- Mark featured products

## Database Schema

- **categories**: Product categories
- **products**: Product catalog
- **cart_items**: Shopping cart items
- **orders**: Customer orders
- **order_items**: Order line items

## Customization

### Adding Product Images
1. Store images in `storage/app/public/products`
2. Run `php artisan storage:link` to create symbolic link
3. Update product records with image paths

### Changing Database
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
