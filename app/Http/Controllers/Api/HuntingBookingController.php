<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\HuntingBooking;
use Illuminate\Http\Request;

class HuntingBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $guide = Guide::find($request->input('guide_id'));

        if (!$guide || !$guide->is_active) {
            return response()->json(['error' => 'Guide not found.'], 404);
        }

        $guideHasBooking = HuntingBooking::where('guide_id', $request->input('guide_id'))
            ->where(function ($query) use ($request) {
                $query->whereBetween('from_date', [$request->input('from_date'), $request->input('to_date')])
                    ->orWhereBetween('to_date', [$request->input('from_date'), $request->input('to_date')])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('from_date', '<=', $request->input('from_date'))
                        ->where('to_date', '>=', $request->input('to_date'));
                    });
            })->exists();
        if ($guideHasBooking) {
            return response()->json(['error' => 'Hunting booking already exists.'], 409);
        }

        if ($request->input('participant_count') > 10){
            return response()->json(['error' => 'Too many participants.'], 409);
        }

        $booking = HuntingBooking::create($request->all());

        return response()->json(['message' => 'Successfully created', 'data' => $booking], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
