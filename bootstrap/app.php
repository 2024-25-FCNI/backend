<?php
 
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
 
 
 
 
$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);
 
$app->register(Illuminate\Mail\MailServiceProvider::class);
$app->configure('mail');
 
return $app->configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   
   
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi(); 
   
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);
   
        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);
   
        //
    })
   
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
 
$app->middleware([
    \Illuminate\Http\Middleware\HandleCors::class,
]);
 
 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');