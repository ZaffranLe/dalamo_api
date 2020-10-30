<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DIP;

class DIPController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dip = DIP::all();
        return response()->json($dip);
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
        $dip = new DIP([
            'idReceipt' => $request->get('idReceipt'),
            'idProduct' => $request->get('idProduct'),
            'quantity' => $request->get('quantity')
        ]);
        $dip->save();
        return response()->json($dip);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dip = DIP::find($id);
        return response()->json($dip);
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
        $dip = DIP::find($id);
        $dip->idReceipt = $request->get('idReceipt');
        $dip->idProduct = $request->get('idProduct');
        $dip->quantity = $request->get('quantity');
        $dip->save();
         return response()->json($dip);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dip = DIP::find($id);
        $dip->delete();
        return response()->json('Detail import product Deleted Successfully');
    }
}
