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

}
