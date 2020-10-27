<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property = DB::table('property')
        ->join('product','product.id','=','property.idProduct')
        ->select('property.id','property.name','property.value')
        ->get();
        return response()->json($property);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $property = new Property([
            'name' => $request->get('name'),
            'value' => $request->get('value'),
            'idProduct' => $request->get('idProduct')
        ]);
        $property->save();
        return response()->json('Add property Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = DB::table('property')
        ->select('id','name','value')
        ->where('id','=',$id)
        ->get();
        return response()->json($property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Property::find($id);
        $role->name = $request->get('name');
        $role->value = $request->get('value');
        $role->idProduct = $request->get('idProduct');
        $role->save();
         return response()->json('Role Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Property::find($id);
        $role->delete();
        return response()->json('Property Deleted Successfully');
    }
}
