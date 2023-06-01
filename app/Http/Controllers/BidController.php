<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidStoreRequest;
use App\Models\Bid;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(BidStoreRequest $request,Car $car)
    {

        // Retrieve the authenticated user's ID
        $userId = Auth::id();
        // $this->authorize('create', $car);

        $validatedData = $request->validated();
        // Check if the bid is higher than the car's highest bid
        if ($car->highestBid && $request->price <= $car->highestBid->price) {
            return response()->json(['error' => 'Your bid must be higher than the current highest bid.'], 422);
        }
        // user can not bid on his own car
       
        $bid = $car->bids()->create(array_merge($validatedData, ['user_id' => $userId]));
        // $bid = Bid::create(array_merge($validatedData, ['user_id' => $userId]));

        return response()->json($bid, 201);
    }
}
