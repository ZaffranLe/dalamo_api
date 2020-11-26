<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('product')
                ->leftJoin('brand', 'brand.id', '=', 'product.idBrand')
                ->leftJoin('category', 'category.id', '=', 'product.idCategory')
                ->select(
                    'product.id',
                    'brand.name as brandName',
                    'product.name',
                    'product.price',
                    'product.description',
                    'product.characteristic',
                    'product.guide',
                    'product.ingredient',
                    'product.preservation',
                    'product.origin',
                    'product.storageQuantity',
                    'product.transportingQuantity',
                    'product.isDiscount',
                    'product.discountPercent',
                    'product.isHot',
                    'product.isNew',
                    'product.slug',
                    'category.name as category_Name',
                    'brand.id as brandId',
                    'category.id as categoryId'
                )
                ->get();

        foreach ($products as $product) {
            $images = DB::table('image')->where('idProduct', '=', $product->id)->get();
            $product->images = $images;
        }
        
        return response()->json($products);
    }


    public function create()
    {
    }

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

    public function show($id)
    {
        $products = DB::table('product')
                ->leftJoin('brand', 'brand.id', '=', 'product.idBrand')
                ->leftJoin('category', 'category.id', '=', 'product.idCategory')
                ->select(
                    'product.id',
                    'brand.name as brandName',
                    'product.name',
                    'product.price',
                    'product.description',
                    'product.characteristic',
                    'product.guide',
                    'product.ingredient',
                    'product.preservation',
                    'product.origin',
                    'product.storageQuantity',
                    'product.transportingQuantity',
                    'product.isDiscount',
                    'product.discountPercent',
                    'product.isHot',
                    'product.isNew',
                    'product.slug',
                    'category.name as categoryName',
                    'brand.id as idBrand',
                    'category.id as idCategory'
                )
                ->where('product.id', '=', $id)
                ->get();

        if (count($products) > 0) {
            $product = $products[0];
            
            $images = DB::table('image')->where('idProduct', '=', $id)->get();
            $product->images = $images;
            
            // $properties = DB::table('property')->select('id', 'name', 'value')->where('idProduct', '=', $id)->get();
            // $product->properties = array($properties);
            
            $comments = DB::table('comment')->leftJoin('user', 'user.id', '=', 'comment.idUser')->select(
                'user.fullName',
                'user.status as userStatus',
                'user.id as idUser',
                'comment.content',
                'comment.rate',
                'comment.status',
                'comment.createdDate',
            )->where('comment.idProduct', '=', $id)->get();
            $product->comments = $comments;
            
            return response()->json($product);
        }

        return response(404);
    }

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
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product);
    }
}
