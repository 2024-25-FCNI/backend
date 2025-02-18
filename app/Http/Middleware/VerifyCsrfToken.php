<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * A CSRF-védelemből kizárt URL-ek listája.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/api/send-payment-confirmation', // Kivételként adjuk hozzá a fizetés API-t
    ];
}
