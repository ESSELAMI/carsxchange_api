<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        return response()->json($cars);
    }

    public function store(CarStoreRequest $request)
    {
        // Retrieve the authenticated user's ID
        $userId = Auth::id();

        // Create the car with the user ID
        $validatedData = $request->validated();
        $car = Car::create(array_merge($validatedData, ['user_id' => $userId]));

        // $car = Car::create($validatedData);

        return response()->json($car, 201);
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);

        return response()->json($car);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'body_type' => 'required',
            'fuel_type' => 'required',
            'seats' => 'required|integer',
            'year' => 'required',
            'picture' => 'required',
            'mileage' => 'required',
        ]);

        $car = Car::findOrFail($id);
        $car->update($validatedData);

        return response()->json($car);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return response()->json(null, 204);
    }
}
