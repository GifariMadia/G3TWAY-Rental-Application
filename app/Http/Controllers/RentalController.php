<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarType;
use App\Models\CarPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RentalController extends Controller
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

    public function show($car_id)
    {
        $car = Car::with(['owner', 'brand', 'type', 'photos', 'reviews'])->findOrFail($car_id);
        return response()->json($car);
    }


    public function update(Request $request, $car_id)
    {
        $car = Car::findOrFail($car_id);

        $validated = $request->validate([
            'brand_name' => 'required|string',
            'car_type' => 'required|string',
            'price_per_day' => 'required|numeric|min:0',
            'specifications' => 'nullable|string',
            'stnk' => 'nullable|file|mimes:pdf|max:2048', 
            'photos_url.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

     
        $brand = CarBrand::firstOrCreate(['brand_name' => $validated['brand_name']]);
  
        $carType = CarType::firstOrCreate(['type_name' => $validated['car_type']]);

        if ($request->hasFile('stnk')) {
            if ($car->stnk && \Storage::disk('public')->exists($car->stnk)) {
                \Storage::disk('public')->delete($car->stnk);
            }

            $stnkPath = $request->file('stnk')->store('stnk', 'public');
            $car->stnk = $stnkPath;
        }

        // Update data mobil
        $car->brand_id = $brand->brand_id;
        $car->type_id = $carType->type_id;
        $car->price_per_day = $validated['price_per_day'];
        $car->specifications = $validated['specifications'];
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

    public function edit($car_id)
    {
        $car = Car::findOrFail($car_id);
        return view('rentals.edit', compact('car'));
    }

    public function destroy($car_id)
    {
        $car = Car::findOrFail($car_id);

        if ($car->stnk && \Storage::disk('public')->exists($car->stnk)) {
            \Storage::disk('public')->delete($car->stnk);
        }

        foreach ($car->photos as $photo) {
            if ($photo->photos_url && \Storage::disk('public')->exists($photo->photos_url)) {
                \Storage::disk('public')->delete($photo->photos_url);
            }
            $photo->delete();
        }

        $car->delete();

        return redirect()->route('rentals.index')->with('success', 'Mobil berhasil dihapus!');
    }

    public function index()
    {
        $cars = Car::with('brand', 'type', 'photos')->get();
        return view('rentals.index', ['cars' => $cars]);
    }
}
