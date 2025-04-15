<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActionLog;

class RatingController extends Controller
{
    // rating product
    public function rating(Request $request)
    {

        Rating::updateOrCreate([
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
        ], [
            'count' => $request->productRating,
        ]);

        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
            'action' => 'rating'
        ]);


        return back();
    }
}
