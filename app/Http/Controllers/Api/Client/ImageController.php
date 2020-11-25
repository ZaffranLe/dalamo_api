<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function index()
    {
        $image = DB::table('image')
        ->select('image.*')
        ->get();
        return response()->json($image);
    }

    public function store(Request $request)
    {
        $image = new Image([
            'name' => $request->get('name'),
            'idProduct' => $request->get('idProduct')
        ]);
        $image->save();
        return response()->json($image);
    }

    public function show($id)
    {
        $image = Image::find($id);
        return response()->json($image);
    }

    public function update(Request $request, $id)
    {
        $image = Image::find($id);
        $image->name = $request->get('name');
        $image->idProduct = $request->get('idProduct');
        $image->save();
         return response()->json($image);
    }
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();
        return response()->json($image);
    }
}
