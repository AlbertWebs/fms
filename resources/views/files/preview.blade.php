<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Preview: {{ $file->original_name }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                margin: 0;
                padding: 0;
                background: #f3f4f6;
            }
            .preview-container {
                height: 100vh;
                display: flex;
                flex-direction: column;
            }
            .preview-header {
                background: linear-gradient(to right, #1f2937, #374151, #1f2937);
                border-bottom: 1px solid rgba(107, 114, 128, 0.5);
                padding: 1rem 1.5rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .preview-title {
                color: white;
                font-size: 1.125rem;
                font-weight: 600;
            }
            .preview-actions {
                display: flex;
                gap: 0.75rem;
            }
            .preview-iframe {
                flex: 1;
                width: 100%;
                border: none;
                background: white;
            }
        </style>
    </head>
    <body>
        <div class="preview-container">
            <div class="preview-header">
                <h1 class="preview-title">{{ $file->original_name }}</h1>
                <div class="preview-actions">
                    <a href="{{ route('files.show', $file) }}" class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to File
                    </a>
                </div>
            </div>
            <iframe src="{{ $url }}" class="preview-iframe" title="File Preview"></iframe>
        </div>
    </body>
</html>
