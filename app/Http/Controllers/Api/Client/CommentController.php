<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('verify.jwt')->only('store');
    }

    public function index()
    {
        $comment = DB::table('comment')
            ->leftJoin('user', 'user.id', '=', 'comment.idUser')
            ->select(
                'comment.content',
                'comment.rate',
                'comment.createdDate',
                'comment.updatedDate',
                'comment.idUser',
                'user.fullname as Fullname'
            )
            ->where('comment.status', '=', 1)
            ->get();
        return response()->json($comment);
    }

    public function store(Request $request)
    {
        $user = $request->user;

        $comment = new Comment([
            'createdBy' => 1,
            'createdDate' =>  time::now(),
            'deletedBy' => $request->get('deletedBy'),
            'deletedDate' => time::now(),
            'idUser' => $user->id,
            'idProduct' => $request->get('idProduct'),
            'rate' => $request->get('rate'),
            'content' => $request->get('content'),
        ]);
        $comment->save();
        return response()->json($comment);
    }

    public function show($id)
    {
        $comment = DB::table('comment')
        ->leftJoin('user', 'user.id', '=', 'comment.idUser')
        ->select('comment.idProduct', 'comment.rate', 'comment.content', 'comment.createdDate', 'comment.updatedDate')
        ->selectRaw('user.fullname as Fullname')
        ->where('comment.idUser', '=', $id)
        ->get();
        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->updatedBy = 1;
        $comment->updatedDate =time::now();
        $comment->deletedBy = $request->get('deletedBy');
        $comment->status = $request->get('status');
        $comment->idUser = $request->get('idUser');
        $comment->idProduct = $request->get('idProduct');
        $comment->save();
        return response()->json($comment);
    }
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json($comment);

        //test
    }
}
