<?php

namespace App\Http\Controllers\Member\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        // Mengambil semua brand dari database
        $brands = Brand::all();

        // Mengirim data brand ke view
        return view('home', compact('brands'));
    }
}
