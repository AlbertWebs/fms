<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    /**
     * Get the storage disk based on USE_AWS configuration
     */
    public static function disk(): \Illuminate\Contracts\Filesystem\Filesystem
    {
        $useAws = env('USE_AWS', false);
        return Storage::disk($useAws ? 's3' : 'local');
    }

    /**
     * Get the disk name
     */
    public static function diskName(): string
    {
        return env('USE_AWS', false) ? 's3' : 'local';
    }

    /**
     * Get file URL (handles both local and S3)
     */
    public static function url(string $path): string
    {
        $disk = self::disk();
        
        if (env('USE_AWS', false)) {
            // For S3, return temporary URL
            return $disk->temporaryUrl($path, now()->addMinutes(60));
        } else {
            // For local storage, we need to use a route to serve files securely
            // Return a route URL that will handle file serving
            return route('files.serve', ['path' => base64_encode($path)]);
        }
    }

    /**
     * Get temporary URL for preview/download (works for both local and S3)
     * Note: For local storage, this returns a route URL that serves the file
     */
    public static function temporaryUrl(string $path, int $minutes = 10): string
    {
        $disk = self::disk();
        
        if (env('USE_AWS', false)) {
            // S3 supports temporary URLs
            return $disk->temporaryUrl($path, now()->addMinutes($minutes));
        } else {
            // For local storage, return a route that will serve the file
            // The FileController download/preview methods handle the actual file serving
            // This URL is used for preview iframes, so we'll need to handle it differently
            // For now, return the download route - preview methods will handle it
            return route('files.download', ['file' => base64_encode($path)]);
        }
    }
}
