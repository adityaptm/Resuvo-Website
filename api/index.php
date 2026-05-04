<?php

use Illuminate\Http\Request;

// Memaksa Laravel mengenali bahwa request ini dari HTTPS (karena Vercel menggunakan HTTPS)
$_SERVER['HTTPS'] = 'on';

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

// Set semua path cache ke /tmp agar tidak bentrok dengan read-only filesystem
$_ENV['APP_CONFIG_CACHE'] = '/tmp/config.php';
$_ENV['APP_EVENTS_CACHE'] = '/tmp/events.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/packages.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/routes.php';
$_ENV['APP_SERVICES_CACHE'] = '/tmp/services.php';
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';

$_ENV['APP_DEBUG'] = 'true';
putenv('APP_DEBUG=true');

$app = require_once __DIR__.'/../bootstrap/app.php';


// Timpa storage path agar menggunakan /tmp
$app->useStoragePath($tmpStorage);

$app->handleRequest(Request::capture());

