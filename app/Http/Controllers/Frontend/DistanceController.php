<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Distance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DistanceController extends Controller
{
    public function index(Request $request)
    {
        $check_user = Distance::where('user_id', Auth::id())->exists();

        if ($check_user) {
            $distance = Distance::where('user_id', Auth::id())->first();
            $distance->name = $request->input('distance');
            $distance->update();
        } else {
            $new_record = new Distance();
            $new_record->user_id = Auth::id();
            $new_record->name = $request->input('distance');
            $new_record->save();
        }
    }
}
