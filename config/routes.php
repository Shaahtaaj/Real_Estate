<?php

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [PageController::class, 'about']);
$router->get('/contact', [PageController::class, 'contact']);
$router->post('/contact', [PageController::class, 'submitContact']);
$router->get('/offline', [PageController::class, 'offline']);
$router->get('/app', [PageController::class, 'app']);
$router->get('/search', [PropertyController::class, 'search']);
$router->get('/properties', [PropertyController::class, 'index']);
$router->get('/property/{slug}', [PropertyController::class, 'show']);
$router->post('/property/{slug}/inquiry', [PropertyController::class, 'inquiry']);
$router->post('/property/{slug}/favorite', [PropertyController::class, 'favorite']);
$router->get('/properties/add', [PropertyController::class, 'add']);
$router->post('/properties/add', [PropertyController::class, 'store']);
$router->get('/properties/{slug}/edit', [PropertyController::class, 'edit']);
$router->post('/properties/{slug}/edit', [PropertyController::class, 'update']);
$router->get('/properties/{slug}/delete', [PropertyController::class, 'delete']);
$router->post('/properties/{slug}/delete', [PropertyController::class, 'destroy']);
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'authenticate']);
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'store']);
$router->get('/forgot-password', [AuthController::class, 'forgot']);
$router->post('/forgot-password', [AuthController::class, 'sendReset']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/dashboard/properties', [DashboardController::class, 'properties']);
$router->get('/dashboard/add-listing', [DashboardController::class, 'addListing']);
$router->get('/dashboard/favorites', [DashboardController::class, 'favorites']);
$router->get('/dashboard/profile', [DashboardController::class, 'profile']);
$router->post('/dashboard/profile', [DashboardController::class, 'updateProfile']);
$router->get('/dashboard/notifications', [DashboardController::class, 'notifications']);
$router->get('/admin', [AdminController::class, 'index']);
$router->get('/admin/users', [AdminController::class, 'users']);
$router->get('/admin/listings', [AdminController::class, 'listings']);
$router->get('/admin/approvals', [AdminController::class, 'approvals']);
$router->get('/admin/analytics', [AdminController::class, 'analytics']);
$router->get('/admin/inquiries', [AdminController::class, 'inquiries']);
$router->post('/admin/listings/{slug}/status', [AdminController::class, 'updateListingStatus']);
$router->post('/admin/users/{id}/status', [AdminController::class, 'updateUserStatus']);
$router->post('/admin/inquiries/{id}/status', [AdminController::class, 'updateInquiryStatus']);

return $router;
