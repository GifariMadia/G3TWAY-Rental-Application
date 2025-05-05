<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return response()->json(Review::with(['car', 'user'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,car_id',
            'user_id' => 'required|exists:users,user_id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'review_date' => 'required|date',
        ]);

        $review = Review::create($validated);
        return response()->json($review, 201);
    }

    public function show($id)
    {
        return response()->json(Review::with(['car', 'user'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'rating' => 'sometimes|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'review_date' => 'sometimes|date',
        ]);

        $review->update($validated);
        return response()->json($review);
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return response()->json(['message' => 'Review deleted successfully']);
    }
}
