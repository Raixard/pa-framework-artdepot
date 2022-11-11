<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    static public function isFollowing($id)
    {
        if (Auth::user()) {
            if (Follow::where('follower_id', Auth::user()->id)
                ->where('following_id', $id)->count() > 0) {
                return true;
            }
        }

        return false;
    }

    // Like a creation
    public function store($id)
    {
        Follow::create([
            'follower_id' => Auth::user()->id,
            'following_id' => $id,
        ]);

        return redirect()->back();
    }

    // Remove a creation
    public function destroy($id)
    {
        $follow = Follow::where('follower_id', Auth::user()->id)
            ->where('following_id', $id)
            ->firstOrFail();

        $follow->delete();

        return redirect()->back();
    }
}
