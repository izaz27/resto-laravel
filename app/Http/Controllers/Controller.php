<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Mendefinisikan konstanta Home Redirect Berdasarkan Role untuk AuthenticatedSessionController
    public const ADMIN_HOME = '/admin/dashboard';
    public const KASIR_HOME = '/kasir/dashboard';
    public const CUSTOMER_HOME = '/'; 
}