<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = DB::table('comment')
            ->leftJoin('user','user.id','=','comment.idUser')
            ->select('comment.content','comment.rate','comment.createdDate','comment.updatedDate',
            'comment.idUser','user.fullname as Fullname')
            ->where('comment.status','=',1)
            ->get();
        return response()->json($comment);
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
        $comment = new Comment([
            'createdBy' => $request->get('createdBy'),
            'createdDate' => $request->get('createdDate'),
            'updatedBy' => $request->get('updatedBy'),
            'updatedDate' => $request->get('updatedDate'),
            'deletedBy' => $request->get('deletedBy'),
            'deletedDate' => $request->get('deletedDate'),
            'status' => $request->get('status'),
            'idUser' => $request->get('idUser'),
            'idProduct' => $request->get('idProduct')
        ]);
        $comment->save();
        return response()->json('Add comment Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = DB::table('comment')
        ->leftJoin('user','user.id','=','comment.idUser')
        ->select('comment.idProduct','comment.rate','comment.content','comment.createdDate','comment.updatedDate')
        ->selectRaw('user.fullname as Fullname')
        ->where('comment.idUser','=' ,$id)
        ->get();
        return response()->json($comment);
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
        $comment = Comment::find($id);
        $comment->createdBy = $request->get('createdBy');
        $comment->createdDate = $request->get('createdDate');
        $comment->updatedBy = $request->get('updatedBy');
        $comment->updatedDate = $request->get('updatedDate');
        $comment->deletedBy = $request->get('deletedBy');
        $comment->deletedDate = $request->get('deletedDate');
        $comment->status = $request->get('status');
        $comment->idUser = $request->get('idUser');
        $comment->idProduct = $request->get('idProduct');
        $comment->save();
         return response()->json('comment Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json('comment Deleted Successfully');

        //test
    }
}
