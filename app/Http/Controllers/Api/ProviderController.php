<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;

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
            'createdBy' => $request->get('createdBy'),
            'createdDate' => $request->get('createdDate'),
            'updatedBy' => $request->get('updatedBy'),
            'updatedDate' => $request->get('updatedDate'),
            'deletedBy' => $request->get('deletedBy'),
            'deletedDate' => $request->get('deletedDate'),
            'status' => $request->get('status')
        ]);
        $provider->save();
        return response()->json('Add Provider Successfully.');
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
        $provider->createdBy = $request->get('createdBy');
        $provider->createdDate = $request->get('createdDate');
        $provider->updatedBy = $request->get('updatedBy');
        $provider->updatedDate = $request->get('updatedDate');
        $provider->deletedBy = $request->get('deletedBy');
        $provider->deletedDate = $request->get('deletedDate');
        $provider->status = $request->get('status');
        $provider->save();
         return response()->json('Provider Update Successfully');
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
        return response()->json('Provider Deleted Successfully');
    }
}
