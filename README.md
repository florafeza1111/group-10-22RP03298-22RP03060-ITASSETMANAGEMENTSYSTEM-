# IT Assets Management System

## About The Project

IT Assets Management System is a web-based application built with Laravel that helps organizations manage their IT assets efficiently. The system provides features for tracking assets, managing technicians, and handling asset assignments and repairs.

## Developed By
- DUKUZUMUREMYI Elias (22RP03298)
- FEZA Flora (22RP03060)

## Features

- User Authentication (Admin and Technician roles)
  Default admin username and password are in this seeders DatabaseSeeder.php
  and the default Technician password is tec@123
  
- Asset Management
- Technician Management
- Asset Assignment System
- Asset Repair Tracking
- User Profile Management

## Tech Stack

- PHP 8.2+
- Laravel 12.0
- Laravel Sanctum for API Authentication
- MySQL Database

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Configure environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Set up database in .env file
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Start the development server:
   ```bash
   php artisan serve
   npm run dev
   ```

## System Architecture

The system follows a standard Laravel MVC architecture with the following key components:

- **Authentication**: Multi-guard authentication for Admin and Technician roles
- **Controllers**: Separate controllers for Admin and Technician functionalities
- **Models**: Eloquent models for Assets, Technicians, and Assignments
- **Views**: Blade templates for the frontend interface
