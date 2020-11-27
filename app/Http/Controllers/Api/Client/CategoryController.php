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

}
