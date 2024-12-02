<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# SI-Barbershop Project

This project is a Barbershop Information System built using the Laravel framework. The system helps manage barbershop operations including appointments, services, and customer management.

## How to Clone the Project

To clone this project, follow the steps below:

1. Open a terminal or command prompt.

2. Navigate to the directory where you want to save the project.

3. Run the following command to clone the repository:
    ```
    git clone https://github.com/RanoLangari/SI-Barbershop.git
    ```

4. After the cloning process is complete, navigate to the project directory:
    ```
    cd SI-Barbershop
    ```

## How to Run the Project

Follow the steps below to run the project:

1. Copy the `.env.example` file to `.env` and configure your database settings:
    ```
    cp .env.example .env
    ```

2. Install PHP dependencies:
    ```
    composer install
    ```

3. Install JavaScript dependencies:
    ```
    npm install
    ```

4. Generate the application key:
    ```
    php artisan key:generate
    ```

5. Run database migrations:
    ```
    php artisan migrate
    ```

6. (Optional) Seed the database with initial data:
    ```
    php artisan db:seed
    ```

7. Compile assets:
    ```
    npm run dev
    ```

8. Start the development server:
    ```
    php artisan serve
    ```

## Using Laragon

If you're using Laragon:

1. Clone the project into Laragon's www directory
2. Configure your `.env` file with your Laragon database settings
3. Open Laragon terminal and run the installation commands mentioned above
4. Access the project through: http://si-barbershop.test

## Features

- Customer Management
- Appointment Scheduling
- Service Management
- Employee Management
- Transaction History
- Reports Generation

# SI-Barbershop