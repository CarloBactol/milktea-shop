## TODOS -

1. Create laravel 8 project
    - composer create-project laravel/laravel="8.\*" milkteashop
2. Intall auth scaffolding
    - composer require laravel/ui:^3.4 // we need version 3 to compatible laravel 8 // fixed bugs
    - php artisan ui:auth // install bootstrap cdn locally
3. create Admin middleware
    - add column to users table as role_as // php artisan make:migration add_role_as_to_users_table
    - create middleware // php artisan make:middleware AdminMiddleware
    - config the AdminMiddleware
    - cofig the Auth login controller
4. Create Routes for admin dashboard
    - config web.php // create dashboard routes
5. Add Dashboard Template
6. Product CRUD
    - product controller
    - Product model
    - product view
7. Orders CRUD
    - orders controller
    - orders model
    - orders view
8. Orders_items
    - orders_items model
    - orders_items view
9. Payment Gateway
    - COD
    - Paypal

## Project Setup

-   Make sure you already have xampp install on your machine || https://www.apachefriends.org/download.html
-   Make sure you already have composer install on your machine || https://getcomposer.org/download/
-   Run composer install in the project root
-   Create Key || php artisan key:generate
-   Create a new MySQL database named milkteashop
-   Copy the .env.example file to a new file called .env
-   Fill out the corresponding database values in the .env file
-   Run php artisan migrate and seed in the project root

## Project Objective

-   -   User Client
    -   User can view best seller Products
    -   User can view Products
    -   User can orders Product
    -   User can view order Cart
    -   User can view pending orders and completed orders
    -   User can payment through COD or Paypal

-   Admin Portal
    -   Manage Create, Read, Update, Delete Products
    -   Manage Create, Read, Update, Delete Bottle Size
    -   Manage Create, Read, Update, Delete Add-Ons or Sinkers

## Final Output:

    # Uers Interface

-   -   Best Seller Page
        ![BESST_SELLER_PRODUCTS!](public/assets/mock/home-best-seller-products.png)
    -   Shop Page
        ![SHOP_PAGE!](public/assets/mock/Shop-page.png)
    -   Single Products Page
        ![SINGLE_PRODUCT!](public/assets/mock/single-product.png)
    -   Cart Page
        ![CART_PAGE!](public/assets/mock/cart-page.png)
    -   Checkout Page
        ![CHECKOUT_PAGE!](public/assets/mock/checkout-page.png)
    -   Paypal Page
        ![PAYPAL_PAYMENT_PAGE!](public/assets/mock/paypal-payment.png)
    -   My Order Page
        ![MY_ORDER_PAGE!](public/assets/mock/my-order.png)
    -   Order Details Page
        ![VIEW_ORDER_DETAIL_PAGE!](public/assets/mock/view-orders-details.png)

    # Admin Interface

    -   Dashboard Page
        ![DASHBOARD_PAGE!](public/assets/mock/admin-dashboard.png)
    -   Product Page
        ![BESST_SELLER_PRODUCTS!](public/assets/mock/product-list.png)
    -   Order Page
        ![BESST_SELLER_PRODUCTS!](public/assets/mock/orders-list.png)
