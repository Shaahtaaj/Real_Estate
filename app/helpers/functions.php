<?php

declare(strict_types=1);

function view(string $view, array $data = []): void
{
    extract($data, EXTR_SKIP);
    $viewPath = APP_PATH . "/views/{$view}.php";

    if (!file_exists($viewPath)) {
        throw new RuntimeException("View not found: {$view}");
    }

    require APP_PATH . '/views/layouts/main.php';
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function asset(string $path): string
{
    $base = defined('ASSET_BASE_PATH') ? ASSET_BASE_PATH : '';
    return $base . '/assets/' . ltrim($path, '/');
}

function upload_asset(string $path): string
{
    $base = defined('ASSET_BASE_PATH') ? ASSET_BASE_PATH : '';
    return $base . '/' . ltrim($path, '/');
}

function url(string $path = ''): string
{
    $base = defined('BASE_PATH') ? BASE_PATH : '';
    $path = '/' . ltrim($path, '/');

    if ($path === '/') {
        return $base === '' ? '/' : $base . '/';
    }

    return $base . $path;
}

function csrf_token(): string
{
    if (empty($_SESSION['_csrf'])) {
        $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

function csrf_is_valid(?string $token): bool
{
    return is_string($token) && hash_equals($_SESSION['_csrf'] ?? '', $token);
}

function flash(?string $key = null, ?string $message = null): mixed
{
    if ($key !== null && $message !== null) {
        $_SESSION['_flash'][$key] = $message;
        return null;
    }

    if ($key === null) {
        return $_SESSION['_flash'] ?? [];
    }

    $value = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $value;
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function is_logged_in(): bool
{
    return current_user() !== null;
}

function is_admin(): bool
{
    return (current_user()['role'] ?? null) === 'admin';
}
