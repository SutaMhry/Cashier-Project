<?php

use Illuminate\Support\Facades\File;

if (!function_exists('getFileSizeFormatted')) {
    function getFileSizeFormatted($filePath)
    {
        if (file_exists($filePath)) {
            $fileSize = filesize($filePath);
            return number_format($fileSize / 1024, 2) . ' KB';
        }
        return 'File not found';
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($value)
    {
        return number_format($value, 2, ',', '.');
    }
}


