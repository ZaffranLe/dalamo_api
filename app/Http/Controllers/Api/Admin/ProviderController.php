<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class ProviderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider = DB::table('provider')
        ->select('id','name','email','address','description','phone')
        ->where('status','=',1)
        ->get();
        return response()->json($provider);
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
        return response()->json($provider);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = DB::table('provider')
        ->select('id','name','email','address','description','phone')
        ->where('id','=',$id)
        ->get();
        return response()->json($provider);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
        return response()->json($provider);
    }
}
