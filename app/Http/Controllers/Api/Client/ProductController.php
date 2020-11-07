<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

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
                ->leftJoin('property','product.id','=','property.idProduct')
                ->leftJoin('brand','brand.id','=','product.idBrand')
                ->leftJoin('category','category.id','=','product.idCategory')
                ->leftJoin('image','image.idProduct','=','product.id')
                ->leftJoin('comment','comment.idProduct','=','product.id')
                ->select('product.id','brand.name as brandName','product.name','product.price',
                'product.description','product.characteristic','product.guide','product.ingredient',
                'product.preservation','product.origin','product.storageQuantity',
                'product.transportingQuantity','product.isDiscount','product.discountPercent',
                'product.isHot','product.isNew','product.slug','image.id as id_img','image.name as name_img',
                'category.name as category_Name','property.id as id_property',
                'property.name as name_property','property.value as value_property'
                ,'brand.id as brandId','category.id as categoryId')
                ->get();
                $productList=[];
                foreach ($product as $val) {
                    if(isset($productList[$val->id])){
                            //Ton tai
                            $productList[$val->id]
                            ['images'][] =[
                                'id_img'=> $val->id_img,
                                'name_img'=> $val->name_img
                            ];
                            $productList[$val->id]
                            ['property'][] =[
                                'id_property'=>$val->id_property,
                                 'name_property'=>$val->name_property,
                                'value_property'=>$val->value_property
                            ];
                        //     ['property'][]=[
                        //         'id_property'=>$val->id_property,
                        //         'name_property'=>$val->name_property,
                        //         'value_property'=>$val->value_property
                        // ];
                            // $productList[]=$item;
                    }else{
                            //Chua ton tai
                            $item = [
                                'id'=> $val->id,
                                'name'=>$val->name,
                                'price'=>$val->price,
                                'description'=>$val->description,
                                'characteristic'=>$val->characteristic,
                                'guide'=>$val->guide,
                                'ingredient'=>$val->ingredient,
                                'preservation'=>$val->preservation,
                                'origin'=>$val->origin,
                                'storageQuantity'=>$val->storageQuantity,
                                'transportingQuantity'=>$val->transportingQuantity,
                                'isDiscount'=>$val->isDiscount,
                                'discountPercent'=>$val->discountPercent,
                                'isHot'=>$val->isHot,
                                'isNew'=>$val->isNew,
                                'slug'=>$val->slug,
                                'categoryId'=>$val->categoryId,
                                'categoryName'=>$val->category_Name,
                                'brandId'=>$val->brandId,
                                'brandName'=>$val->brandName,
                                'images'=> [
                                    ['id_img'=> $val->id_img,
                                    'name_img'=> $val->name_img]
                                ],
                                'property' => [
                                    [
                                    'id_property'=>$val->id_property,
                                    'name_property'=>$val->name_property,
                                    'value_property'=>$val->value_property]
                                    ]
                                ];
                            $productList[$val->id] =$item;
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


        return response()->json(array_values($productList));
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
            'createdBy' => 1,
            'createdDate' =>  time::now(),
            'status' => $request->get('status'),
            'isHot' => $request->get('isHot'),
            'isNew' => $request->get('isNew'),
            'idCategory' => $request->get('idCategory'),
        ]);
        $product->save();
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('product')
                ->leftJoin('property','product.id','=','property.idProduct')
                ->leftJoin('brand','brand.id','=','product.idBrand')
                ->leftJoin('category','category.id','=','product.idCategory')
                ->leftJoin('image','image.idProduct','=','product.id')
                ->leftJoin('comment','comment.idProduct','=','product.id')
                ->select('product.id','brand.name as brandName','product.name','product.price',
                'product.description','product.characteristic','product.guide','product.ingredient',
                'product.preservation','product.origin','product.storageQuantity',
                'product.transportingQuantity','product.isDiscount','product.discountPercent',
                'product.isHot','product.isNew','product.slug','image.id as id_img','image.name as name_img',
                'category.name as category_Name','property.id as id_property',
                'property.name as name_property','property.value as value_property'
                ,'brand.id as brandId','category.id as categoryId')
                ->where('product.id' , '=' ,$id)
                ->get();
                $productList=[];
                foreach ($product as $val) {
                    if(isset($productList[$val->id])){
                            //Ton tai
                            $productList[$val->id]
                            ['images'][] =[
                                'id_img'=> $val->id_img,
                                'name_img'=> $val->name_img
                            ];
                            $productList[$val->id]
                            ['property'][] =[
                                'id_property'=>$val->id_property,
                                 'name_property'=>$val->name_property,
                                'value_property'=>$val->value_property
                            ];
                        //     ['property'][]=[
                        //         'id_property'=>$val->id_property,
                        //         'name_property'=>$val->name_property,
                        //         'value_property'=>$val->value_property
                        // ];
                            // $productList[]=$item;
                    }else{
                            //Chua ton tai
                            $item = [
                                'id'=> $val->id,
                                'name'=>$val->name,
                                'price'=>$val->price,
                                'description'=>$val->description,
                                'characteristic'=>$val->characteristic,
                                'guide'=>$val->guide,
                                'ingredient'=>$val->ingredient,
                                'preservation'=>$val->preservation,
                                'origin'=>$val->origin,
                                'storageQuantity'=>$val->storageQuantity,
                                'transportingQuantity'=>$val->transportingQuantity,
                                'isDiscount'=>$val->isDiscount,
                                'discountPercent'=>$val->discountPercent,
                                'isHot'=>$val->isHot,
                                'isNew'=>$val->isNew,
                                'slug'=>$val->slug,
                                'categoryId'=>$val->categoryId,
                                'categoryName'=>$val->category_Name,
                                'brandId'=>$val->brandId,
                                'brandName'=>$val->brandName,
                                'images'=> [
                                    ['id_img'=> $val->id_img,
                                    'name_img'=> $val->name_img]
                                ],
                                'property' => [
                                    [
                                    'id_property'=>$val->id_property,
                                    'name_property'=>$val->name_property,
                                    'value_property'=>$val->value_property]
                                    ]
                                ];
                            $productList[$val->id] =$item;
                    }
                }
                return response()->json($productList);
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
        $product->updatedBy =1;
        $product->updatedDate = time::now();
        $product->status = $request->get('status');
        $product->isHot = $request->get('isHot');
        $product->isNew = $request->get('isNew');
        $product->idCategory = $request->get('idCategory');
        $product->save();
        return response()->json($product);
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
        return response()->json($product);
    }
}
