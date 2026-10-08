<?php

namespace App\Libraries;

class MediaStore
{
    public static function usesDatabase(): bool
    {
        return db_connect()->DBDriver === 'Postgre';
    }

    public static function save(string $filename, string $path, string $mime = 'image/jpeg'): void
    {
        $bytes = file_get_contents($path);
        if ($bytes === false) {
            throw new \RuntimeException('The prepared image could not be read.');
        }

        $table = db_connect()->table('uploaded_media');
        $table->where('filename', $filename)->delete();
        $table->insert([
            'filename' => $filename,
            'mime_type' => $mime,
            'data_base64' => base64_encode($bytes),
        ]);
    }

    public static function find(string $filename): ?array
    {
        $row = db_connect()->table('uploaded_media')->where('filename', $filename)->get()->getRowArray();
        if (! $row) {
            return null;
        }

        $row['bytes'] = base64_decode($row['data_base64'], true) ?: '';
        return $row;
    }

    public static function delete(string $filename): void
    {
        db_connect()->table('uploaded_media')->where('filename', $filename)->delete();
    }
}
