<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Car;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'price' => 'required|numeric',
        'user_id' => 'required|exists:users,id',
        'car_id' => [
            'required',
            'exists:cars,id',
            function ($value, $fail) use ($request) {
                $car = Car::findOrFail($value);
                if ($car->user_id === $request->user_id) {
                    $fail("You cannot bid on your own car.");
                }
            },
        ],
    ]);

    $bid = Bid::create($validatedData);

    return response()->json($bid, 201);
}

}
