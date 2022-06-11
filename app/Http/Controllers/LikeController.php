<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Store Like register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function darMg(Request $request)
    {
        $publi_id = $request['publi_id'];
        $mg = Like::create([
            'user_id' => Auth::user()->id,
            'publication_id' => $publi_id
        ]);

        $result = $mg->save();

        return response()
            ->json([
                'result' => $result
            ]);
    }

    /**
     * Delete Like register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function quitarMg(Request $request)
    {
        $publi_id = $request['publi_id'];
        $mg = Like::where('user_id', Auth::user()->id)->where('publication_id', $publi_id)->get()->first();

        $result = $mg->delete();

        return response()
            ->json([
                'result' => $result
            ]);
    }
}
