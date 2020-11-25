<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class CategoryController extends Controller
{
    public function index()
    {
        $category = DB::table('category')
        ->select('id','slug','name','status')
        ->get();
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $category = new Category([
            'slug' => $request->get('slug'),
            'name' => $request->get('name'),
            'status' => $request->get('status'),
            'createdBy' => 1,
            'createdDate' =>  time::now()
        ]);
        $category->save();
        return response()->json($category);
    }

    public function show($id)
    {
        $category = DB::table('category')
        ->select('id','slug','name')
        ->where('id','=',$id)
        ->get();

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->slug = $request->get('slug');
        $category->status = $request->get('status');
        $category->name = $request->get('name');
        $category->updatedBy = 1;
        $category->updatedDate = time::now();
        $category->save();
         return response()->json($category);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json($category);
    }
}
