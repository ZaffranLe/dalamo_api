<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function index()
    {
        $property = DB::table('property')
        ->join('product','product.id','=','property.idProduct')
        ->select('property.id','property.name','property.value')
        ->get();
        return response()->json($property);
    }

    public function store(Request $request)
    {
        $property = new Property([
            'name' => $request->get('name'),
            'value' => $request->get('value'),
            'idProduct' => $request->get('idProduct')
        ]);
        $property->save();
        return response()->json($property);
    }

    public function show($id)
    {
        $property = DB::table('property')
        ->select('id','name','value')
        ->where('id','=',$id)
        ->get();
        return response()->json($property);
    }

    public function update(Request $request, $id)
    {
        $property = Property::find($id);
        $property->name = $request->get('name');
        $property->value = $request->get('value');
        $property->idProduct = $request->get('idProduct');
        $property->save();
         return response()->json($property);
    }
    public function destroy($id)
    {
        $property = Property::find($id);
        $property->delete();
        return response()->json($property);
    }
}
