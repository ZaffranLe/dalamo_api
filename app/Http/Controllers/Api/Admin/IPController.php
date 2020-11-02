<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\IP;
use Carbon\Carbon as time;

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
        $import_product = DB::table('import_product')
                ->leftJoin('detail_import_product','import_product.id','=','detail_import_product.idReceipt')
                ->leftJoin('provider','provider.id','=','import_product.id')
                ->leftJoin('product','detail_import_product.idProduct','=','product.id')
                ->select('import_product.id','import_product.importDate','provider.name as providerName',
                'detail_import_product.quantity as totalPrice','product.name as nameProduct','product.id as idProduct')
                ->get();
                $productList=[];
                foreach($import_product as $val){
                    if(isset($productList[$val->id])){
                        // Tồn tại
                        $productList[$val->id]['product'][]=[
                            'idProduct'=>$val->idProduct,
                            'nameProduct'=>$val->nameProduct,
                            'totalPrice'=>$val->totalPrice
                        ];
                    }
                    else{
                        $item=[
                            'id'=>$val->id,
                            'importDate'=>$val->importDate,
                            'providerName'=>$val->providerName,
                            'product'=>[
                                'idProduct'=>$val->idProduct,
                                'nameProduct'=>$val->nameProduct
                            ]
                            ];
                        $productList[$val->id]=$item;
                    }
                }
        return response()->json($productList);
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
            'createdBy' => 1,
            'createdDate' =>  time::now(),
            'idProvider' => $request->get('idProvider'),
            'importDate' => $request->get('importDate'),
            'totalPrice' => $request->get('totalPrice')
        ]);
        $ip->save();
        return response()->json($ip);
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
        $ip->idProvider = $request->get('idProvider');
        $ip->importDate = $request->get('importDate');
        $ip->totalPrice = $request->get('totalPrice');
        $ip->save();
         return response()->json($ip);
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
        return response()->json($ip);
    }
}
