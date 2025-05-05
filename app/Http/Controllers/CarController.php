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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|string',  
            'car_type' => 'required|string',    
            'price_per_day' => 'required|numeric|min:0',
            'specifications' => 'nullable|string',
            'stnk' => 'required|file|mimes:pdf|max:2048',
            'photos_url.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

      
        $user_id = Auth::id();

       
        $stnkPath = $request->file('stnk')->store('stnk', 'public');

        
        $brand = CarBrand::firstOrCreate(['brand_name' => $validated['brand_name']]);

        
        $carType = CarType::firstOrCreate(['type_name' => $validated['car_type']]);

       
        $car = Car::create([
            'user_id' => $user_id,
            'brand_id' => $brand->brand_id,
            'type_id' => $carType->type_id,
            'price_per_day' => $validated['price_per_day'],
            'status' => 'avail',
            'specifications' => $validated['specifications'],
            'stnk' => $stnkPath,
        ]);

        
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

        return redirect()->route('rentals.index')->with('success', 'Mobil berhasil ditambahkan!');
    }



    public function show($id)
    {
        $car = Car::with(['owner', 'brand', 'type', 'photos', 'reviews'])->findOrFail($id);
        return response()->json($car);
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


    public function showCarsForRentals()
    {
        $cars = Car::with('brand', 'type', 'photos')->get(); // Ambil semua mobil dengan relasi
        return view('rentals.index', ['cars' => $cars]); // Kirim ke view rentals/index.blade.php
    }
    
}
