<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$brand = Product::all();
        $brand = DB::table('product')
                // ->leftJoin('property','product.id','=','property.idProduct')
                ->leftJoin('brand','brand.id','=','product.idBrand')
                ->leftJoin('product_category','product_category.idProduct','=','product.id')
                ->leftJoin('category','product_category.idCategory','=','category.id')
                ->selectRaw('product.*')
                ->selectRaw('brand.name as brandName')
                ->selectRaw('category.name as categoryName')
                ->get();
        return response()->json($brand);
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
        $brand = new Product([
            'name' => $request->get('name'),
            'idBrand' => $request->get('idBrand'),
            'price' => $request->get('price'),
            'description' => $request->get('description'),
            'characteristic' => $request->get('characteristic'),
            'guide' => $request->get('guide'),
            'ingredient' => $request->get('ingredient'),
            'preservation' => $request->get('preservation'),
            'origin' => $request->get('origin'),
            'storageQuantity' => $request->get('storageQuantity'),
            'transportingQuantity' => $request->get('transportingQuantity'),
            'isDiscount' => $request->get('isDiscount'),
            'discountPercent' => $request->get('discountPercent'),
            'createdBy' => $request->get('createdBy'),
            'createdDate' => $request->get('createdDate'),
            'updatedBy' => $request->get('updatedBy'),
            'updatedDate' => $request->get('updatedDate'),
            'deletedBy' => $request->get('deletedBy'),
            'deletedDate' => $request->get('deletedDate'),
            'isDeleted' => $request->get('isDeleted'),
            'isHot'=>$request->get('isHot'),
            'isNew'=>$request->get('isNew')
        ]);
        $brand->save();
        return response()->json('Add Product Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Product::find($id);
        return response()->json($brand);
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
        $brand = Product::find($id);
        $brand->name = $request->get('name');
        $brand->idBrand = $request->get('idBrand');
        $brand->price = $request->get('price');
        $brand->description = $request->get('description');
        $brand->characteristic = $request->get('characteristic');
        $brand->guide = $request->get('guide');
        $brand->ingredient = $request->get('ingredient');
        $brand->preservation = $request->get('preservation');
        $brand->origin = $request->get('origin');
        $brand->storageQuantity = $request->get('storageQuantity');
        $brand->transportingQuantity = $request->get('transportingQuantity');
        $brand->isDiscount = $request->get('isDiscount');
        $brand->discountPercent = $request->get('discountPercent');
        $brand->createdBy = $request->get('createdBy');
        $brand->createdDate = $request->get('createdDate');
        $brand->updatedBy = $request->get('updatedBy');
        $brand->updatedDate = $request->get('updatedDate');
        $brand->deletedBy = $request->get('deletedBy');
        $brand->deletedDate = $request->get('deletedDate');
        $brand->isDeleted = $request->get('isDeleted');
        $brand->isDeleted = $request->get('isHot');
        $brand->isDeleted = $request->get('isNew');
        $brand->save();
         return response()->json('Product Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Product::find($id);
        $brand->delete();
        return response()->json('Product Deleted Successfully');
    }
}
