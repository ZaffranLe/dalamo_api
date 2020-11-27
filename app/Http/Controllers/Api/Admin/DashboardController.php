<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Order_receipt;
use Carbon\Carbon as time;

class DashboardController extends Controller
{
    public function index()
    {
        $data = (object)[];
        $customers = User::where([['status', '=', 1], ['idRole', '=' , 2]])->orderByDesc('createdDate')->limit(10)->get();
        $data->customers = $customers;
        $data->order_count = Order_receipt::all()->count();
        $data->product_count = Product::all()->count();
        $data->brand_count = Brand::all()->count();
        $data->customer_count = count($customers);
        $data->orders = Order_receipt::whereBetween(DB::raw('DATE(createdDate)'), [DB::raw('DATE(CURDATE()) - INTERVAL 15 DAY'), DB::raw('DATE(CURDATE())')])
        ->select(DB::raw('COUNT(*) as count, DATE(createdDate) as date'))
        ->groupBy(DB::raw('Date(createdDate)'))
        ->get();
        
        return response()->json($data);
    }
}
