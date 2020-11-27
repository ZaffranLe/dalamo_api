<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Brand;
use Carbon\Carbon as time;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::all();
        return response()->json($brand);
    }

    public function store(Request $request)
    {
        $brand = new Brand([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'imagrUrl' => $request->get('imagrUrl'),
            'createdBy' => 1,
            'createdDate' =>  time::now(),
            'status' => $request->get('status'),
        ]);
        $brand->save();
        return response($brand, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        return response()->json($brand);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->get('name');
        $brand->slug = $request->get('slug');
        $brand->imagrUrl = $request->get('imagrUrl');
        $brand->updatedBy = 1;
        $brand->updatedDate = time::now();
        $brand->status = $request->get('status');
        $brand->save();
         return response()->json($brand);
    }
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return response()->json($brand);

        //test
    }
}
