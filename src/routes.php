<?php

use App\Controllers\AuthenticationController;
use App\Router;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\EmployeeController;

// Usage:
$router = new Router();

// Add routes
$router->addRoute('/\//', [new UserController(), 'index']);

$router->addRoute('/\/product/', [new ProductController(), 'index']);
$router->addRoute('/\/product\/show\/(\d+)/', [new ProductController(), 'show']);
$router->addRoute('/\/product\/create/', [new ProductController(), 'create']);
$router->addRoute('/\/product\/update\/(\d+)/', [new ProductController(), 'update']);
$router->addRoute('/\/product\/delete\/(\d+)/', [new ProductController(), 'delete']);

$router->addRoute('/\/user\/show\/(\d+)/', [new UserController(), 'show']);
$router->addRoute('/\/user\/create/', [new UserController(), 'create']);
$router->addRoute('/\/user\/update\/(\d+)/', [new UserController(), 'update']);
$router->addRoute('/\/user\/delete\/(\d+)/', [new UserController(), 'delete']);

$router->addRoute('/\/auth\/login/', [new AuthenticationController(), 'login']);
$router->addRoute('/\/auth\/validate/', [new AuthenticationController(), 'authenticate']);
$router->addRoute('/\/auth\/logout/', [new AuthenticationController(), 'logout']);

$router->addRoute('/\/category/', [new CategoryController(), 'index']);
$router->addRoute('/\/category\/create/', [new CategoryController(), 'create']);
$router->addRoute('/\/category\/update\/(\d+)/', [new CategoryController(), 'update']);
$router->addRoute('/\/category\/delete\/(\d+)/', [new CategoryController(), 'delete']);

$router->addRoute('/\/employee/', [new EmployeeController(), 'index']);
$router->addRoute('/\/employee\/index/', [new EmployeeController(), 'index']);
$router->addRoute('/\/employee\/create/', [new EmployeeController(), 'create']);
$router->addRoute('/\/employee\/update\/(\d+)/', [new EmployeeController(), 'update']);
$router->addRoute('/\/employee\/delete\/(\d+)/', [new EmployeeController(), 'delete']);