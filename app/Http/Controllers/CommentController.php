<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sended = false;

        $text = filter_var($request['text'],FILTER_UNSAFE_RAW);
        $publication_id = $request['publication_id'];
        $authUserId = Auth::user()->id;

        $comment = Comment::create([
            'text' => $text,
            'user_id' => $authUserId,
            'publication_id' => $publication_id
        ]);

        $comment->save();
        $sended = true;

        return response()
            ->json([
                'sended' => $sended
            ]);
    }

}
