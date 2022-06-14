<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class FollowerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request['user_id'];
        $authUser = Auth::user();
        $followed = false;

        $follow = Follower::create([
            'account_id' => $user_id,
            'follower_id' => $authUser->id
        ]);

        $follow->save();
        $followed = true;

        return response()
            ->json([
                'followed' => $followed
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_id = $request['user_id'];
        $authUserId = Auth::user()->id;
        $unfollowed = false;

        $follow = Follower::where('account_id', $user_id)->where('follower_id', $authUserId);

        $follow->delete();
        $unfollowed = true;

        return response()
            ->json([
                'unfollowed' => $unfollowed
            ]);
    }

    /**
     * get followers of the user passed in param
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUserFollowers(Request $request)
    {
        $listaFollowers = [];
        $followersAvatars = [];
        $followers = [];
        $followList = [];
        $user_id = $request['user_id'];
        $userAuth = User::find(Auth::user()->id);
        $account_followerList = [];


        $account_followerList = Follower::where('account_id', $user_id)->get();

        foreach ($account_followerList as $key => $value) {
            array_push($listaFollowers, $value->follower_id);
        }

        $followers = User::whereIn('id', $listaFollowers)->get();

        foreach ($followers as $key => $value) {
            $follow_boolean = false;

            $filename = $value->avatar;
            $file = Storage::disk('users')->get($filename);

            $imageBase64 = base64_encode($file);
            $stringCompletoImage = "data:image/png;base64,$imageBase64";

            $followersAvatars[$value->id] = $stringCompletoImage;


            $seguidor = Follower::where('account_id', $value->id)->where('follower_id', $userAuth->id)->get();
            if (sizeof($seguidor) > 0) {
                $follow_boolean = true;
            }

            $followList[$value->id] = $follow_boolean;
        }

        return response()
            ->json([
                'users' => $followers,
                'avatars' => $followersAvatars,
                'authFollowList' => $followList
            ]);
    }

    /**
     * get followed users of the user passed in param
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUserFollowed(Request $request)
    {
        $listaFollowed = [];
        $followedAvatars = [];
        $followed = [];
        $followedList = [];
        $user_id = $request['user_id'];
        $userAuth = User::find(Auth::user()->id);
        $account_followerList = [];

        $account_followerList = Follower::where('follower_id', $user_id)->get();

        foreach ($account_followerList as $key => $value) {
            array_push($listaFollowed, $value->account_id);
        }

        $followed = User::whereIn('id', $listaFollowed)->get();

        foreach ($followed as $key => $value) {
            $follow_boolean = false;

            $filename = $value->avatar;
            $file = Storage::disk('users')->get($filename);

            $imageBase64 = base64_encode($file);
            $stringCompletoImage = "data:image/png;base64,$imageBase64";

            $followedAvatars[$value->id] = $stringCompletoImage;


            $seguido = Follower::where('account_id', $value->id)->where('follower_id', $userAuth->id)->get();
            if (sizeof($seguido) > 0) {
                $follow_boolean = true;
            }

            $followedList[$value->id] = $follow_boolean;
        }

        return response()
            ->json([
                'users' => $followed,
                'avatars' => $followedAvatars,
                'authFollowList' => $followedList
            ]);
    }

    /**
     * get true if the user_id passed in param is followed by the autenticated user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkFollow(Request $request)
    {
        $user_id = $request['user_id'];
        $boolean_Followed = false;
        $userAuth = User::find(Auth::user()->id);
        $seguidor = Follower::where('account_id', $user_id)->where('follower_id', $userAuth->id)->get();
        if (sizeof($seguidor) > 0) {
            $boolean_Followed = true;
        }

        return new Response($boolean_Followed, 200);
    }
}
