<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\VendorMiddleware;
use App\Http\Middleware\ManufacturerMiddleware;
use App\Http\Middleware\ServiceMiddleware;
use App\Http\Middleware\RealEstateMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

       $middleware->alias([

    'admin'         => AdminMiddleware::class,
    'vendor'        => VendorMiddleware::class,

    'manufacturer'  => ManufacturerMiddleware::class,
    'servicevendor' => ServiceMiddleware::class,
    'realestate'    => RealEstateMiddleware::class,

]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
