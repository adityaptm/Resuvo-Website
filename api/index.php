<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

// Buat struktur direktori storage di /tmp karena Vercel read-only
$tmpStorage = '/tmp/storage';
if (!file_exists($tmpStorage . '/framework/views')) {
    mkdir($tmpStorage . '/framework/views', 0777, true);
    mkdir($tmpStorage . '/framework/cache', 0777, true);
    mkdir($tmpStorage . '/framework/sessions', 0777, true);
    mkdir($tmpStorage . '/logs', 0777, true);
}

$app = require_once __DIR__.'/../bootstrap/app.php';

// Timpa storage path agar menggunakan /tmp
$app->useStoragePath($tmpStorage);

$app->handleRequest(Request::capture());

