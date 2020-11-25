<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;
use ImageKit\ImageKit;


class ProductController extends Controller
{
    public $imageKit;

    public function __construct() {
        $this->imageKit = new ImageKit(
            "public_imOmw/PdIbfdFSEGH5ix1+CRzH8=",
            "private_i2838I8dlY6aeAoVmarAV48gh1I=",
            "https://ik.imagekit.io/utcbot"
        );
    }

    public function index()
    {
        $products = DB::table('product')->get();
        foreach($products as $product) {
            $images = DB::table('image')->where('idProduct', '=', $product->id)->get();
            $product->images = $images;
        }
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = json_decode($request->data);
        $info = $data->info;

        $product = new Product([
            'name' => $info->name,
            'slug' => $info->slug,
            'description' => $info->description ?? null,
            'characteristic' => $info->characteristic ?? null,
            'guide' => $info->guide ?? null,
            'ingredient' => $info->ingredient ?? null,
            'preservation' => $info->preservation ?? null,
            'origin' => $info->origin ?? null,
            'price' => $info->price ?? null,
            'isDiscount' => $info->isDiscount ?? 0,
            'isHot' => $info->isHot ?? 0,
            'isNew' => $info->isNew ?? 0,
            'discountPercent' => $info->discountPercent ?? null,
            'storageQuantity' => $info->storageQuantity ?? null,
            'transportingQuantity' => $info->transportingQuantity ?? null,
            'idBrand' => $info->idBrand ?? null,
            'idCategory' => $info->idCategory ?? null,
            'status' => $info->status ?? 1,
            'createdBy' => 1,
            'createdDate' => time::now(),
        ]);

        $product->save();

        if ($request->hasFile('files')) {
            $files =  $request->file('files');
            $images = [];
            foreach ($files as $file) {
                $base64 = base64_encode(file_get_contents($file));
                $uploadFile = $this->imageKit->upload(array(
                    'file' => $base64,
                    'fileName' => time::now()->timestamp,
                    'folder' => 'dalamo'
                ));
                if($uploadFile->success !== NULL) {
                    $imageUploaded = $uploadFile->success;
                    $image = new Image([
                        'idProduct' =>  $product->id,
                        'fileId' => $imageUploaded->fileId,
                        'name' => $imageUploaded->name,
                        'size' => $imageUploaded->size,
                        'height' => $imageUploaded->height,
                        'width' => $imageUploaded->width,
                        'thumbnailUrl' => $imageUploaded->thumbnailUrl,
                        'url' => $imageUploaded->url,
                        'filePath' => $imageUploaded->filePath,
                        'createdDate' => time::now(),
                    ]);
                    $image->save();
                    array_push($images, $image);
                }
            }
            $product->images = $images;
        }

        return response()->json($product);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $data = json_decode($request->data);
        $info = $data->info;

        $product = Product::find($id);

        $product->name = $info->name ?? $product->name;
        $product->slug = $info->slug ?? $product->slug;
        $product->description = $info->description ?? $product->description;
        $product->characteristic = $info->characteristic ?? $product->characteristic;
        $product->guide = $info->guide ?? $product->guide;
        $product->ingredient = $info->ingredient ?? $product->ingredient;
        $product->preservation = $info->preservation ?? $product->preservation;
        $product->origin = $info->origin ?? $product->origin;
        $product->price = $info->price ?? $product->price;
        $product->isDiscount = $info->isDiscount ?? $product->isDiscount;
        $product->isHot = $info->isHot ?? $product->isHot;
        $product->isNew = $info->isNew ?? $product->isNew;
        $product->discountPercent = $info->discountPercent ?? $product->discountPercent;
        $product->storageQuantity = $info->storageQuantity ?? $product->storageQuantity;
        $product->transportingQuantity = $info->transportingQuantity ?? $product->transportingQuantity;
        $product->idBrand = $info->idBrand ?? $product->idBrand;
        $product->idCategory = $info->idCategory ?? $product->o;
        $product->status = $info->status ?? $product->status;
        $product->updatedBy =1;
        $product->updatedDate = time::now();

        $product->save();

        if(property_exists($data, 'images')) {
            if ($request->hasFile('files')) {
                $files =  $request->file('files');
                foreach ($files as $file) {
                    $base64 = base64_encode(file_get_contents($file));
                    $uploadFile = $this->imageKit->upload(array(
                        'file' => $base64,
                        'fileName' => time::now()->timestamp,
                        'folder' => 'dalamo'
                    ));
                    if($uploadFile->success !== NULL) {
                        $imageUploaded = $uploadFile->success;
                        $image = new Image([
                            'idProduct' =>  $product->id,
                            'fileId' => $imageUploaded->fileId,
                            'name' => $imageUploaded->name,
                            'size' => $imageUploaded->size,
                            'height' => $imageUploaded->height,
                            'width' => $imageUploaded->width,
                            'thumbnailUrl' => $imageUploaded->thumbnailUrl,
                            'filePath' => $imageUploaded->filePath,
                            'url' => $imageUploaded->url,
                            'createdDate' => time::now(),
                        ]);
                        $image->save();
                    }
                }
            }
            if(count($data->images->delete) > 0) {
                Image::destroy($data->images->delete);
            }
        }
        $images = DB::table('image')->where('idProduct', '=', $product->id)->get();
        $product->images = $images;
        return response()->json($product);
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product);
    }
}
