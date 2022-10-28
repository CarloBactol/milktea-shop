<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetIpAddressController extends Controller
{
    public function index(Request $request)
    {
        $ip = $request->ip();
        dd($ip);
    }
}
