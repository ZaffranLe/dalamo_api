<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function show($id)
    {
        $product = DB::table('product')
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
                ->get()->first();

        if ($product) {
            
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

        return response(Response::HTTP_NOT_FOUND);
    }
}
