<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->paginate(6);
        return view('public.hotels.index', compact('hotels'));
    }


public function show($id)
{
    $hotels = Hotel::with('rooms')->findOrFail($id);

    return view('public.hotels.show', compact('hotels'));
}

}
