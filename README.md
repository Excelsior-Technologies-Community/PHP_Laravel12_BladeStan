# PHP_Laravel12_BladeStan

## Introduction

**PHP_Laravel12_BladeStan** is a modern Laravel 12 project that demonstrates how to integrate **Bladestan**, a powerful PHPStan extension, to perform static analysis on Blade templates.

The project focuses on detecting common Blade issues such as undefined variables, missing views, and rendering errors **before runtime**, helping developers improve code quality, maintainability, and debugging efficiency.

This project is designed as a practical example of combining Laravel’s Blade templating system with advanced static analysis tools used in real-world development.

---

## Project Overview

This project showcases the integration of **Laravel 12**, **Blade templating**, and **Bladestan (PHPStan extension)** to create a development workflow that ensures early error detection.

The application includes a simple posts listing feature built using a controller and Blade view, styled with Tailwind CSS. Static analysis is performed using PHPStan with Bladestan to validate both backend logic and Blade templates.

By combining UI rendering with static analysis, the project demonstrates how developers can build reliable Laravel applications while minimizing runtime errors.

---

## Project Features

* Laravel 12 setup with clean structure
* Blade template rendering using controller data
* Bladestan integration for Blade static analysis
* PHPStan configuration with analysis levels
* Real-time error detection in Blade files

---

## Requirements

* PHP >= 8.1
* Composer
* Laravel 12
* XAMPP / Laragon / Local server

---

## Installation & Setup

## Step 1: Create Laravel Project

```bash
composer create-project laravel/laravel PHP_Laravel12_BladeStan "12.*"
cd PHP_Laravel12_BladeStan
```

---

## Step 2: Install Dependencies

```bash
composer require --dev phpstan/phpstan
composer require --dev tomasvotruba/bladestan
```
---

## Bladestan Configuration

## Step 3: Create phpstan.neon

Create file in root:

```
phpstan.neon
```

## Step 4: Add Configuration

```yaml
includes:
    - ./vendor/tomasvotruba/bladestan/config/extension.neon

parameters:
    level: 7
    paths:
        - app
        - resources/views
```

---

##  Sample Implementation

## Step 5: Create Controller

```bash
php artisan make:controller PostController
```

---

## Step 6: Add Controller Logic

File: `app/Http/Controllers/PostController.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = [
            ['title' => 'Post 1', 'content' => 'Content 1'],
            ['title' => 'Post 2', 'content' => 'Content 2'],
        ];

        return view('posts.index', compact('posts'));
    }
}
```

---

## Step 7: Create Blade Template

File: `resources/views/posts/index.blade.php`

```blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-5xl mx-auto p-6">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800">📚 All Posts</h1>
            <p class="text-gray-500 mt-2">A simple Laravel + Blade UI</p>
        </div>

        <!-- Posts Grid -->
        <div class="grid md:grid-cols-2 gap-6">
            @foreach($posts as $post)
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300">

                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    {{ $post['title'] }}
                </h2>

                <p class="text-gray-600">
                    {{ $post['content'] }}
                </p>

            
                <div class="mt-4 text-right">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        Read More
                    </button>
                </div>

            </div>
            @endforeach
        </div>

    </div>

</body>

</html>
```

---

## Step 8: Add Route

File: `routes/web.php`

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 

Route::get('/posts', [PostController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
```

---

## Step 9: Running the Application

Start Laravel server:

```bash
php artisan serve
```

Open browser:

```
http://127.0.0.1:8000/posts
```

---

## Step 10: Running Blade Static Analysis

Run PHPStan with Bladestan:

```bash
vendor\bin\phpstan analyse --error-format=blade
```

---

## Demonstrating Error Detection

To test Bladestan, add an intentional error:

```blade
{{ $undefinedVariable }}
```

Run analysis again:

```bash
vendor\bin\phpstan analyse --error-format=blade
```

### Expected Output

```
Undefined variable: $undefinedVariable
```

---

## Output

<img src="screenshots/Screenshot 2026-03-18 102106.png" width="1000">
 
<img src="screenshots/Screenshot 2026-03-18 102150.png" width="1000">
 
<img src="screenshots/Screenshot 2026-03-18 102542.png" width="1000"> 

---

## Project Structure

```
PHP_Laravel12_BladeStan/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── PostController.php
│   │   └── ...
│   └── Models/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
│   ├── views/
│   │   └── posts/
│   │       └── index.blade.php <- Blade templates go here
│   └── css/
├── routes/
│   └── web.php
├── storage/
├── tests/
├── composer.json
└── phpstan.neon <- Bladestan config file
```

---

Your PHP_Laravel12_BladeStan Project is now ready!
