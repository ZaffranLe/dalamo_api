<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class ProviderController extends Controller
{
    public function index()
    {
        $provider = DB::table('provider')
        ->select('id','name','email','address','description','phone', 'status')
        ->get();
        return response()->json($provider);
    }

    public function store(Request $request)
    {
        $provider = new Provider([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'description' => $request->get('description'),
            'phone' => $request->get('phone'),
            'createdBy' => 1,
            'createdDate' => time::now(),
            'status' => $request->get('status')
        ]);
        $provider->save();
        return response($provider, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $provider = DB::table('provider')
        ->select('id','name','email','address','description','phone')
        ->where('id','=',$id)
        ->get();
        return response()->json($provider);
    }

    public function update(Request $request, $id)
    {
        $provider = Provider::find($id);
        $provider->name = $request->get('name');
        $provider->email = $request->get('email');
        $provider->address = $request->get('address');
        $provider->description = $request->get('description');
        $provider->phone = $request->get('phone');
        $provider->updatedBy = 1;
        $provider->updatedDate = time::now();
        $provider->status = $request->get('status');
        $provider->save();
         return response()->json($provider);
    }
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
        return response()->json($provider);
    }
}
