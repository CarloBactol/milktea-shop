<?php

namespace App\Http\Controllers\Admin;

use App\Models\PremiumAddon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PremiumController extends Controller
{
    public function index(Request $request)
    {

        $premium_addons = PremiumAddon::all();
        return view('admin.premiumAddons.index', compact('premium_addons'));
    }
}
