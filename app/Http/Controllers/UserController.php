<?php

namespace App\Http\Controllers;

use App\Models\Creation;
use App\Models\Follow;
use App\Models\Like;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    // Viewing user detail page
    function show($username, $purpose = 'gallery')
    {
        // Currently viewed user
        $viewedUser = User::where('username', $username)->first();
        
        // Viewed user's creations
        // $creations = $viewedUser->creations;
        $endpoint = env('BASE_ENV') . '/api/creations/user/' . $viewedUser->id;
        $client = new Client();
        $response = $client->request('GET', $endpoint);
        $creations = json_decode($response->getBody(), true)["data"];

        // If this is viewed user's liked page
        $endpoint = env('BASE_ENV') . '/api/creations/user/' . $viewedUser->id . '/liked';
        $client = new Client();
        $response = $client->request('GET', $endpoint);
        $likedCreations = json_decode($response->getBody(), true)["data"];

        // If the logged user is following this user
        $isFollowing = FollowController::isFollowing($viewedUser->id);

        // Like and comment counters
        $likesReceived = 0;
        $commentsReceived = 0;

        // Follower and following counters
        $followers = $viewedUser->followers;
        $followings = $viewedUser->following;

        // Accumulate likes and comments received by viewed user
        foreach ($creations as $creation) {
            $likesReceived += count($creation['likes']);
            $commentsReceived += $creation['commentCount'];
        }

        // Show page
        return view('users.show', [
            'purpose' => $purpose,
            'user' => $viewedUser,
            'creations' => $creations,
            'likedCreations' => $likedCreations,
            'isFollowing' => $isFollowing,
            'likesReceived' => $likesReceived,
            'commentsReceived' => $commentsReceived,
            'followers' => $followers,
            'followings' => $followings,
        ]);
    }

    // Viewing user's liked creation page
    function showLiked($username)
    {
        return $this->show($username, 'liked');
    }

    // Viewing user's followers page
    function showFollowers($username)
    {
        return $this->show($username, 'followers');
    }

    // Viewing user's following page
    function showFollowings($username)
    {
        return $this->show($username, 'followings');
    }

    // Viewing user profile edit page
    function edit($username)
    {
        return view('users.edit', [
            'user' => User::where('username', $username)->first(),
        ]);
    }

    // Updating user info
    function update(Request $request, $username)
    {
        // Data validation
        $request->validate([
            'image' => [
                'nullable', 'image', 'mimes:jpeg,jpg,png', 'dimensions:ratio:1/1'
            ],
            'biography' => ['nullable', 'max:255'],
        ]);

        // Find user
        $viewed_user = User::where('username', $username)->first();

        // If user uploads image, update user profile image
        if ($request->file('image')) {
            if (
                File::exists(public_path('img/users/' . $viewed_user->profile_image)) &&
                $viewed_user->profile_image != 'user-default.jpg'
            ) {
                File::delete(public_path('img/users/' . $viewed_user->profile_image));
            }

            $image = $request->file('image');
            $filename = $viewed_user->id . '.' . $image->extension();

            $image_resized = Image::make($image->getRealPath());
            $image_resized->resize(128, 128);
            $image_resized->save(public_path('img/users/') . $filename);

            $viewed_user->profile_image = $filename;
        }

        // Save information
        $viewed_user->biography = $request->biography;
        $viewed_user->save();

        // Redirect
        return redirect()->route('userShow', $username);
    }
}
