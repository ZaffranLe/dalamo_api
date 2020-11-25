<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DIP;

class DIPController extends Controller
{
    public function index()
    {
        $dip = DIP::all();
        return response()->json($dip);
    }

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

    public function show($id)
    {
        $dip = DIP::find($id);
        return response()->json($dip);
    }

    public function update(Request $request, $id)
    {
        $dip = DIP::find($id);
        $dip->idReceipt = $request->get('idReceipt');
        $dip->idProduct = $request->get('idProduct');
        $dip->quantity = $request->get('quantity');
        $dip->save();
         return response()->json($dip);
    }
    public function destroy($id)
    {
        $dip = DIP::find($id);
        $dip->delete();
        return response()->json($dip);
    }
}
