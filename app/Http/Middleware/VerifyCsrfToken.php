<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/register',
        '/admin/reports/export',
        'admin/transactions/bulk-actions/barcode',
        'customer/verify-address',
        'my-settings',
        'admin/transactions/bulk-actions/barcode'
    ];

}
