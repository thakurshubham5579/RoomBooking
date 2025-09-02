<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('rooms')->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(HotelRequest $request)
    {
        Hotel::create($request->validated());

        return redirect()->route('admin.hotels.index')->withSuccess('Hotel added successfully');

    }

       public function show($id)
    {
        $hotels = Hotel::with('rooms')->findOrFail($id);
        return view('admin.hotels.show', compact('hotels'));
    }

      public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotels.edit', compact('hotel'));
    }

    public function update(HotelRequest $request,$id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->validated());

        return redirect()->route('admin.hotels.index')->withSeccess('Hotel updated successfully');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('admin.hotels.index')->withSuccess('Hotel deleted successfully');
    }
    
}