<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Mulai waktu eksekusi Laravel
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Maintenance Mode Check
|--------------------------------------------------------------------------
|
| Jika aplikasi sedang dalam maintenance, file ini akan dijalankan.
|
*/
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Composer Autoload
|--------------------------------------------------------------------------
|
| Memuat semua dependensi Laravel dari folder vendor.
|
*/
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Bootstrap Laravel
|--------------------------------------------------------------------------
|
| Memuat file bootstrap/app.php untuk menyiapkan aplikasi Laravel.
|
*/
$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Handle Request
|--------------------------------------------------------------------------
|
| Laravel akan menangani HTTP request dan mengirim response.
|
*/
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Request::capture();
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);
