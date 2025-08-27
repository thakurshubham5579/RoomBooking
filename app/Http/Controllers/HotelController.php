<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('rooms')->get();
        return view('hotels.index', compact('hotels'));
    }

    public function show($id)
    {
        $hotels = Hotel::with('rooms')->findOrFail($id);
        return view('hotels.show', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(HotelRequest $request)
    {
        Hotel::create($request->validated());

        return redirect()->route('hotel.index')->withSuccess('Hotel added successfully');

    }

    public function update(HotelRequest $request,$id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->validated());

        return redirect()->route('hotels.index')->withSeccess('Hotel updated successfully');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('hotel.index')->withSuccess('Hotel deleted successfully');
    }
    
}
