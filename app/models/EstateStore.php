<?php

declare(strict_types=1);

class EstateStore
{
    public static function all(): array
    {
        self::ensureFile();
        $data = json_decode((string) file_get_contents(self::file()), true);
        return is_array($data) ? $data : self::seed();
    }

    public static function save(array $data): void
    {
        if (!is_dir(dirname(self::file()))) {
            mkdir(dirname(self::file()), 0775, true);
        }

        file_put_contents(self::file(), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    public static function properties(?array $filters = null, bool $admin = false): array
    {
        $properties = self::all()['properties'];

        if (!$admin) {
            $properties = array_values(array_filter($properties, fn (array $property): bool => $property['status'] === 'active'));
        }

        if (!$filters) {
            return $properties;
        }

        return array_values(array_filter($properties, function (array $property) use ($filters): bool {
            foreach (['city', 'area', 'purpose', 'property_type'] as $field) {
                $haystack = (string) ($property[$field] ?? '');
                if ($field === 'area') {
                    $haystack .= ' ' . (string) ($property['location'] ?? '');
                }

                if (!empty($filters[$field]) && stripos($haystack, (string) $filters[$field]) === false) {
                    return false;
                }
            }

            if (!empty($filters['beds']) && (int) $property['beds'] < (int) $filters['beds']) {
                return false;
            }

            if (!empty($filters['baths']) && (int) $property['baths'] < (int) $filters['baths']) {
                return false;
            }

            if (!empty($filters['min_price']) && (float) $property['price_value'] < (float) $filters['min_price']) {
                return false;
            }

            if (!empty($filters['max_price']) && (float) $property['price_value'] > (float) $filters['max_price']) {
                return false;
            }

            return true;
        }));
    }

    public static function property(string $slug): ?array
    {
        foreach (self::all()['properties'] as $property) {
            if ($property['slug'] === $slug) {
                return $property;
            }
        }

        return null;
    }

    public static function userProperties(int $userId): array
    {
        return array_values(array_filter(self::all()['properties'], fn (array $property): bool => (int) $property['user_id'] === $userId));
    }

    public static function upsertProperty(array $input, ?string $slug = null, array $uploadedImages = []): array
    {
        $data = self::all();
        $user = current_user();
        $title = trim($input['title'] ?? 'Untitled Property');
        $newSlug = $slug ?: self::uniqueSlug(self::slugify($title), $data['properties']);
        $existing = $slug ? self::property($slug) : null;
        $images = $uploadedImages ?: ($existing['images'] ?? []);
        $image = $images[0]['webp'] ?? trim($input['image'] ?? '') ?: ($existing['image'] ?? 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85');

        $property = [
            'id' => $existing['id'] ?? time(),
            'user_id' => $existing['user_id'] ?? (int) ($user['id'] ?? 0),
            'slug' => $newSlug,
            'title' => $title,
            'description' => trim($input['description'] ?? ''),
            'city' => trim($input['city'] ?? 'Karachi'),
            'area' => trim($input['area'] ?? ''),
            'location' => trim(($input['area'] ?? '') . ', ' . ($input['city'] ?? 'Karachi'), ' ,'),
            'purpose' => $input['purpose'] ?? 'sale',
            'type' => ($input['purpose'] ?? 'sale') === 'rent' ? 'For Rent' : 'For Sale',
            'property_type' => $input['property_type'] ?? 'Apartment',
            'price' => trim($input['price'] ?? 'PKR 0'),
            'price_value' => (float) preg_replace('/[^0-9.]/', '', (string) ($input['price_value'] ?? $input['price'] ?? 0)),
            'beds' => (int) ($input['beds'] ?? 0),
            'baths' => (int) ($input['baths'] ?? 0),
            'area_size' => trim($input['area_size'] ?? ''),
            'image' => $image,
            'images' => $images,
            'status' => $existing['status'] ?? 'pending',
            'created_at' => $existing['created_at'] ?? date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($slug) {
            foreach ($data['properties'] as $index => $item) {
                if ($item['slug'] === $slug) {
                    $data['properties'][$index] = $property;
                }
            }
        } else {
            $data['properties'][] = $property;
        }

        self::save($data);
        return $property;
    }

    public static function deleteProperty(string $slug): void
    {
        $data = self::all();
        $data['properties'] = array_values(array_filter($data['properties'], fn (array $property): bool => $property['slug'] !== $slug));
        $data['favorites'] = array_values(array_filter($data['favorites'], fn (array $favorite): bool => $favorite['property_slug'] !== $slug));
        self::save($data);
    }

    public static function setPropertyStatus(string $slug, string $status): void
    {
        $data = self::all();
        foreach ($data['properties'] as &$property) {
            if ($property['slug'] === $slug) {
                $property['status'] = $status;
                $property['updated_at'] = date('Y-m-d H:i:s');
            }
        }
        unset($property);
        self::save($data);
    }

    public static function toggleFavorite(int $userId, string $slug): bool
    {
        $data = self::all();
        foreach ($data['favorites'] as $index => $favorite) {
            if ((int) $favorite['user_id'] === $userId && $favorite['property_slug'] === $slug) {
                unset($data['favorites'][$index]);
                $data['favorites'] = array_values($data['favorites']);
                self::save($data);
                return false;
            }
        }

        $data['favorites'][] = ['user_id' => $userId, 'property_slug' => $slug, 'created_at' => date('Y-m-d H:i:s')];
        self::save($data);
        return true;
    }

    public static function favorites(int $userId): array
    {
        $data = self::all();
        $slugs = array_column(array_filter($data['favorites'], fn (array $favorite): bool => (int) $favorite['user_id'] === $userId), 'property_slug');
        return array_values(array_filter($data['properties'], fn (array $property): bool => in_array($property['slug'], $slugs, true)));
    }

    public static function addInquiry(array $input, string $slug): void
    {
        $data = self::all();
        $data['inquiries'][] = [
            'id' => time(),
            'property_slug' => $slug,
            'name' => trim($input['name'] ?? ''),
            'phone' => trim($input['phone'] ?? ''),
            'message' => trim($input['message'] ?? ''),
            'status' => 'new',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        self::save($data);
    }

    public static function updateInquiryStatus(int $id, string $status): void
    {
        $data = self::all();
        foreach ($data['inquiries'] as &$inquiry) {
            if ((int) $inquiry['id'] === $id) {
                $inquiry['status'] = $status;
            }
        }
        unset($inquiry);
        self::save($data);
    }

    public static function updateUserStatus(int $id, string $status): void
    {
        $data = self::all();
        foreach ($data['users'] as &$user) {
            if ((int) $user['id'] === $id) {
                $user['status'] = $status;
            }
        }
        unset($user);
        self::save($data);
    }

    public static function stats(): array
    {
        $data = self::all();
        return [
            'users' => count($data['users']),
            'listings' => count($data['properties']),
            'pending' => count(array_filter($data['properties'], fn (array $property): bool => $property['status'] === 'pending')),
            'inquiries' => count($data['inquiries']),
        ];
    }

    private static function ensureFile(): void
    {
        if (file_exists(self::file())) {
            return;
        }

        self::save(self::seed());
    }

    private static function seed(): array
    {
        return [
            'users' => [
                ['id' => 1, 'name' => 'Test User', 'email' => 'user@memonestate.test', 'role' => 'seller', 'status' => 'active'],
                ['id' => 2, 'name' => 'Test Admin', 'email' => 'admin@memonestate.test', 'role' => 'admin', 'status' => 'active'],
                ['id' => 3, 'name' => 'Agent Demo', 'email' => 'agent@memonestate.test', 'role' => 'agent', 'status' => 'active'],
            ],
            'properties' => [
                ['id' => 101, 'user_id' => 1, 'slug' => 'clifton-sea-view-penthouse', 'title' => 'Clifton Sea View Penthouse', 'description' => 'Premium sea-facing penthouse with modern finishes and private terrace.', 'city' => 'Karachi', 'area' => 'Clifton Block 4', 'location' => 'Clifton Block 4, Karachi', 'purpose' => 'sale', 'type' => 'For Sale', 'property_type' => 'Penthouse', 'price' => 'PKR 8.5 Cr', 'price_value' => 85000000, 'beds' => 4, 'baths' => 5, 'area_size' => '4,200 sq ft', 'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85', 'status' => 'active', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 102, 'user_id' => 1, 'slug' => 'dha-phase-8-villa', 'title' => 'DHA Phase 8 Modern Villa', 'description' => 'Spacious family villa with garden, parking, and smart home upgrades.', 'city' => 'Karachi', 'area' => 'DHA Phase 8', 'location' => 'DHA Phase 8, Karachi', 'purpose' => 'rent', 'type' => 'For Rent', 'property_type' => 'Villa', 'price' => 'PKR 6.2 Lac/mo', 'price_value' => 620000, 'beds' => 5, 'baths' => 6, 'area_size' => '1,000 sq yd', 'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=85', 'status' => 'pending', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 103, 'user_id' => 3, 'slug' => 'bahadurabad-family-apartment', 'title' => 'Bahadurabad Family Apartment', 'description' => 'Well-planned apartment near schools, markets, and restaurants.', 'city' => 'Karachi', 'area' => 'Bahadurabad', 'location' => 'Bahadurabad, Karachi', 'purpose' => 'sale', 'type' => 'For Sale', 'property_type' => 'Apartment', 'price' => 'PKR 2.1 Cr', 'price_value' => 21000000, 'beds' => 3, 'baths' => 3, 'area_size' => '1,850 sq ft', 'image' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1200&q=85', 'status' => 'active', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ],
            'favorites' => [['user_id' => 1, 'property_slug' => 'bahadurabad-family-apartment', 'created_at' => date('Y-m-d H:i:s')]],
            'inquiries' => [
                ['id' => 501, 'property_slug' => 'clifton-sea-view-penthouse', 'name' => 'Iqbal Khan', 'phone' => '+92 300 0000000', 'message' => 'Please share viewing details.', 'status' => 'new', 'created_at' => date('Y-m-d H:i:s')],
            ],
        ];
    }

    private static function file(): string
    {
        return ROOT_PATH . '/storage/data/app.json';
    }

    private static function slugify(string $value): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value), '-'));
        return $slug ?: 'property';
    }

    private static function uniqueSlug(string $slug, array $properties): string
    {
        $existing = array_column($properties, 'slug');
        $candidate = $slug;
        $count = 2;

        while (in_array($candidate, $existing, true)) {
            $candidate = "{$slug}-{$count}";
            $count++;
        }

        return $candidate;
    }
}
