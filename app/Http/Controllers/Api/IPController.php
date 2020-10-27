<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\IP;

class IPController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$brand = IP::all();
        $data = DB::table(' ')
                ->join('detail_import_product','import_product.id','=','detail_import_product.idReceipt')
                ->join('provider','provider.id','=','import_product.id')
                ->select('import_product.id','import_product.importDate','provider.name as providerName','detail_import_product.quantity as totalPrice')
                ->get();
        return response()->json($data);
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
        $ip = new IP([
            'createdBy' => $request->get('createdBy'),
            'createdDate' => $request->get('createdDate'),
            'idProvider' => $request->get('idProvider'),
            'importDate' => $request->get('importDate'),
            'totalPrice' => $request->get('totalPrice')
        ]);
        $ip->save();
        return response()->json('Add Import product Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ip = IP::find($id);
        return response()->json($ip);
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
        $ip = IP::find($id);
        $ip->createdBy = $request->get('createdBy');
        $ip->createdDate = $request->get('createdDate');
        $ip->idProvider = $request->get('idProvider');
        $ip->importDate = $request->get('importDate');
        $ip->totalPrice = $request->get('totalPrice');
        $ip->save();
         return response()->json('Import product Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ip = IP::find($id);
        $ip->delete();
        return response()->json('Import product Deleted Successfully');
    }
}
