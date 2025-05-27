<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarType;
use App\Models\CarPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
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
        $car = Car::findOrFail($id);


        $validated = $request->validate([
            'price_per_day' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string',
            'specifications' => 'nullable|string',
            'stnk' => 'nullable|file|mimes:pdf|max:2048',
            'photos_url.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->has('price_per_day')) {
            $car->price_per_day = $validated['price_per_day'];
        }

        if ($request->has('status')) {
            $car->status = $validated['status'];
        }

        if ($request->has('specifications')) {
            $car->specifications = $validated['specifications'];
        }

        if ($request->hasFile('stnk')) {
            $stnkPath = $request->file('stnk')->store('stnk', 'public');
            $car->stnk = $stnkPath;
        }

        $car->save();

        if ($request->hasFile('photos_url')) {
            $files = $request->file('photos_url');
            foreach (array_slice($files, 0, 3) as $file) {
                $path = $file->store('photos_url', 'public');
                CarPhoto::create([
                    'car_id' => $car->car_id,
                    'photos_url' => $path,
                ]);
            }
        }

        return redirect()->route('rentals.index')->with('success', 'Mobil berhasil diperbarui!');
    }



    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        if ($car->stnk && Storage::exists('public/' . $car->stnk)) {
            Storage::delete('public/' . $car->stnk);
        }

        foreach ($car->photos as $photo) {
            if (Storage::exists('public/' . $photo->photos_url)) {
                Storage::delete('public/' . $photo->photos_url);
            }
            $photo->delete();
        }

        $car->delete();

        return response()->json(['message' => 'Car deleted successfully']);
    }
}
