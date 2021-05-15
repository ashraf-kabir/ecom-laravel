# Laravel Ecommerce site
<br>

#### **Description:** Full ecommerce site using laravel, mysql, js & jquery with Stripe payment. Followed MVC structure. Separate login for admin & customer. Customer can add product to cart. Then checkout & pay using Stripe. Admin can add products, categories, view products, categories, orders.
<br>

## Features
- **Customer->register, login, view products, add to cart, checkout**
- **Admin->login, add products, categories. View products, categories, orders**
- **Stripe payment gateway**
- **Separate user panel for admin & customer. (on progress)**
<br>

## Languages & frameworks
- **Laravel 8**
- **Javascript**
- **JQuery**
- **MySql**
- **HTML5**
- **CSS3**
<br>

## Instructions to install (linux)
1. #### clone the repo into htdocs directory
    ```bash
    cd /opt/lampp/htdocs
    git clone https://github.com/ashraf-kabir/ecom-laravel.git
    ```

2. #### open the project
    ```bash
    cd chmod -R 777 ecom-laravel
    cd ecom-laravel
    ```

3. #### open the project into VSCode editor
    ```bash
    code .
    ```

4. Create .env file & add below stripe variables
    ```bash
    STRIPE_PUBLISHABLE_KEY=YOUR_STRIPE_PUBLISHABLE_KEY
    STRIPE_SECRET_KEY=YOUR_STRIPE_SECRET_KEY
    ```

5. Run the project when inside ecom-laravel dir
    ```bash
    php artisan serve
    ```

6. Create a database on mysql using php phpmyadmin & set below variables on .env.
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=DATABASE_NAME
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7. If you don't have any mysql login password, keep the DB_PASSWORD blank.

8. open the project url **http://127.0.0.1:8000**

## Raise a star to support.