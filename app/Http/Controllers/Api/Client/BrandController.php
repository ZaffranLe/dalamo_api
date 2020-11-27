<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon as time;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::all();
        return response()->json($brand);
    }

}
