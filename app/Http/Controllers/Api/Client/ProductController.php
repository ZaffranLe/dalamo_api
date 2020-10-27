<?php

namespace App\Http\Controllers\Api\Client;

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

        $product = DB::table('product')
                // ->leftJoin('property','product.id','=','property.idProduct')
                ->leftJoin('brand','brand.id','=','product.idBrand')
                ->leftJoin('category','category.id','=','product.idCategory')
                ->leftJoin('image','image.idProduct','=','product.id')
                ->leftJoin('comment','comment.idProduct','=','product.id')
                ->select('product.id','brand.name as brandName','product.name','product.price','product.description'
                ,'product.characteristic','product.guide','product.ingredient','product.preservation','product.origin'
                ,'product.storageQuantity','product.transportingQuantity','product.isDiscount',
                'product.discountPercent','product.isHot','product.isNew','image.id as id_img','image.name as name_img',
                'category.name as category_Name','category.slug as category_Slug','category.id as category_Id')
                ->get();
                $productList=[];
                foreach ($product as $val) {
                    if(isset($productList[$val->id])){
                            //Ton tai
                            $item =$productList[$val->id];
                            $item = [
                                'category'=> [
                                    'id_cate'=> $val->idCategory
                                ]
                            ];
                    }else{
                            //Chua ton tai
                            $item = [
                                'id'=> $val->id,
                                'category'=> [
                                    'id_cate'=> $val->id
                                ]
                                ];
                            $productList[] =$item;
                    }
                }

            // foreach ($product as $val){

            // $cate = DB::table('category')->where('category.id',)
            // ->select('category.name as categoryName','category.slug as categorySlug','category.id as categoryId')
            // ->get();
            // }
            // $val->category = $cate;

        // $cate = DB::table('category')
        //     ->select('category.name')
        //     ->get();
        // $result = [
        //     'product' => [
        //         $product,
        //         $cate
        //     ]
        // ];


        return response()->json($product);
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
        $product = new Product([
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
            'status' => $request->get('status'),
            'isHot' => $request->get('isHot'),
            'isNew' => $request->get('isNew'),
            'idCategory' => $request->get('idCategory'),
        ]);
        $product->save();
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
        $product = Product::find($id);
        return response()->json($product);
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
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->idBrand = $request->get('idBrand');
        $product->price = $request->get('price');
        $product->description = $request->get('description');
        $product->characteristic = $request->get('characteristic');
        $product->guide = $request->get('guide');
        $product->ingredient = $request->get('ingredient');
        $product->preservation = $request->get('preservation');
        $product->origin = $request->get('origin');
        $product->storageQuantity = $request->get('storageQuantity');
        $product->transportingQuantity = $request->get('transportingQuantity');
        $product->isDiscount = $request->get('isDiscount');
        $product->discountPercent = $request->get('discountPercent');
        $product->createdBy = $request->get('createdBy');
        $product->createdDate = $request->get('createdDate');
        $product->updatedBy = $request->get('updatedBy');
        $product->updatedDate = $request->get('updatedDate');
        $product->deletedBy = $request->get('deletedBy');
        $product->deletedDate = $request->get('deletedDate');
        $product->status = $request->get('status');
        $product->isHot = $request->get('isHot');
        $product->isNew = $request->get('isNew');
        $product->idCategory = $request->get('idCategory');
        $product->save();
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
        $product = Product::find($id);
        $product->delete();
        return response()->json('Product Deleted Successfully');
    }
}
