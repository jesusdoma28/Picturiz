<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;
use function Psy\debug;

class PublicationController extends Controller
{
    /**
     * Muestra la feed del usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = [];
        $likesList = [];
        $likes = [];
        $meGusta = [];
        $usersList = [];

        $seguidos = Follower::where('follower_id', Auth::user()->id)->get();
        foreach ($seguidos as $key => $value) {
            array_push($lista, (String)$value->account_id);
            debug($lista);
        }

        $publications = Publication::whereIn('user_id',  $lista)->get();
        foreach ($publications as $key => $value) {
            $user = User::find($value->user_id);

            $meGustaBool = false;
            $likesList[$value->id] = Publication::find($value->id)->likes;
            $likes[$value->id] = sizeof($likesList[$value->id]);

            $usersList[$value->user_id] = $user;

            foreach ($likesList[$value->id] as $keyL => $valueL) {
                if ( ($meGusta == false) && ($valueL->user_id == Auth::user()->id) ) {
                    $meGustaBool = true;
                }
            }



            $meGusta[$value->id] = $meGustaBool;
        }

        return response()
        ->json([
            'publis' => $publications,
            'likes' => $likes,
            'meGusta' => $meGusta,
            'users' => $usersList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resources linked to the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userPublications($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
