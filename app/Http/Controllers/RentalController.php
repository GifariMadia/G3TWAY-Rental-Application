<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function showAllCars()
    {
        // Ambil semua mobil beserta relasi brand, type, dan photos
        $cars = Car::with('brand', 'type', 'photos')->get();
        
        // Mengirimkan data mobil ke view cars.index
        return view('cars.index', ['cars' => $cars]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'car_id' => 'required|exists:cars,car_id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $rental = Rental::create($validated);
        return response()->json($rental, 201);
    }

    public function show($car_id)
{
    $car = Car::with('photos', 'brand')->find($car_id);

    if (!$car) {
        return redirect()->route('cars.index')->with('error', 'Mobil tidak ditemukan');
    }

    $photos_url = $car->photos->first()->photos_url ?? null;
    $brand_name = $car->brand->brand_name ?? null;
    $price_per_day = $car->price_per_day;

    return view('cars.detail', compact('car', 'photos_url', 'brand_name', 'price_per_day'));
}


    public function update(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);

        $validated = $request->validate([
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
        ]);

        $rental->update($validated);
        return response()->json($rental);
    }

    public function destroy($id)
    {
        Rental::findOrFail($id)->delete();
        return response()->json(['message' => 'Rental deleted successfully']);
    }
}
