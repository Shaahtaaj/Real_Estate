<?php

declare(strict_types=1);

class ImageUpload
{
    private const MAX_BYTES = 5242880;
    private const ALLOWED_MIME = ['image/jpeg', 'image/png', 'image/webp'];

    public static function propertyImages(array $files): array
    {
        if (empty($files['name'])) {
            return [];
        }

        if (!is_array($files['name'])) {
            $files = [
                'name' => [$files['name']],
                'type' => [$files['type'] ?? null],
                'tmp_name' => [$files['tmp_name'] ?? null],
                'error' => [$files['error'] ?? UPLOAD_ERR_NO_FILE],
                'size' => [$files['size'] ?? 0],
            ];
        }

        $results = [];
        $baseDir = PUBLIC_PATH . '/uploads/properties/' . date('Y/m');
        $publicBase = 'uploads/properties/' . date('Y/m');

        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0775, true);
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);

        foreach ($files['name'] as $index => $name) {
            if (($files['error'][$index] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            if (($files['error'][$index] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK || ($files['size'][$index] ?? 0) > self::MAX_BYTES) {
                continue;
            }

            $tmp = $files['tmp_name'][$index] ?? '';
            $mime = $tmp ? $finfo->file($tmp) : '';

            if (!in_array($mime, self::ALLOWED_MIME, true)) {
                continue;
            }

            $safeName = self::slug(pathinfo((string) $name, PATHINFO_FILENAME));
            $stamp = bin2hex(random_bytes(5));
            $originalExt = match ($mime) {
                'image/png' => 'png',
                'image/webp' => 'webp',
                default => 'jpg',
            };

            $originalPath = "{$baseDir}/{$safeName}-{$stamp}.{$originalExt}";
            $webpPath = "{$baseDir}/{$safeName}-{$stamp}.webp";
            $thumbPath = "{$baseDir}/{$safeName}-{$stamp}-thumb.webp";

            if (!move_uploaded_file($tmp, $originalPath)) {
                continue;
            }

            $webpOk = self::convertToWebp($originalPath, $webpPath, 1200, 82);
            $thumbOk = self::convertToWebp($originalPath, $thumbPath, 420, 78);

            $results[] = [
                'original' => "{$publicBase}/" . basename($originalPath),
                'webp' => $webpOk ? "{$publicBase}/" . basename($webpPath) : "{$publicBase}/" . basename($originalPath),
                'thumbnail' => $thumbOk ? "{$publicBase}/" . basename($thumbPath) : ($webpOk ? "{$publicBase}/" . basename($webpPath) : "{$publicBase}/" . basename($originalPath)),
            ];
        }

        return $results;
    }

    private static function convertToWebp(string $source, string $destination, int $maxWidth, int $quality): bool
    {
        if (!extension_loaded('gd') || !function_exists('imagewebp')) {
            return false;
        }

        [$width, $height, $type] = getimagesize($source) ?: [0, 0, 0];
        if ($width <= 0 || $height <= 0) {
            return false;
        }

        $image = match ($type) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($source),
            IMAGETYPE_PNG => imagecreatefrompng($source),
            IMAGETYPE_WEBP => imagecreatefromwebp($source),
            default => false,
        };

        if (!$image) {
            return false;
        }

        $targetWidth = min($width, $maxWidth);
        $targetHeight = (int) round($height * ($targetWidth / $width));
        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);
        imagealphablending($canvas, true);
        imagesavealpha($canvas, true);
        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
        $saved = imagewebp($canvas, $destination, $quality);
        imagedestroy($image);
        imagedestroy($canvas);

        return $saved;
    }

    private static function slug(string $name): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        return $slug ?: 'property';
    }
}
