<?php

declare(strict_types=1);

class Property
{
    public static function featured(): array
    {
        require_once APP_PATH . '/models/EstateStore.php';
        return EstateStore::properties();
    }

    public static function findBySlug(string $slug): ?array
    {
        require_once APP_PATH . '/models/EstateStore.php';
        return EstateStore::property($slug);
    }
}
