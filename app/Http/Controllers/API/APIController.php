<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Creation;
use App\Models\Follow;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getCreations($userId = 0, $random = false, $creationId = 0)
    {
        $creations = Creation::latest()->get();

        if ($userId > 0) {
            $creations = $creations->where('user_id', $userId);
            if ($creationId > 0) {
                $creations = $creations->where('id', '!=', $creationId);
            }

            if ($random == true) {
                $creations = $creations->shuffle();
            }
        }

        // Add all relationship
        foreach ($creations as $creation) {
            // User
            $creation['user'] = $creation->user;

            // Comments
            $creation['commentCount'] = 0;
            $creation['comments'] = $creation->comments;
            foreach ($creation['comments'] as $comment) {
                $comment['user'] = $comment->user;

                $comment['replies'] = $comment->replies;
                foreach ($comment['replies'] as $reply) {
                    $reply['user'] = $reply->user;
                }

                $creation['commentCount'] += 1 + count($comment['replies']);
            }

            // Likes
            $creation['likes'] = $creation->likes;
        }

        $respon = [
            'status' => 'succcess',
            'msg' => 'Get Data Creations Berhasil',
            'data' => $creations,
        ];

        return response()->json($respon);
    }

    public function getCreation($id)
    {
        $creation = Creation::where('id', $id)->first();

        // User
        $creation['user'] = $creation->user;

        // Comments
        $creation['commentCount'] = 0;
        $creation['comments'] = $creation->comments;
        foreach ($creation['comments'] as $comment) {
            $comment['user'] = $comment->user;

            $comment['replies'] = $comment->replies;
            foreach ($comment['replies'] as $reply) {
                $reply['user'] = $reply->user;
                $reply['replies'] = $reply->replies;
            }

            $creation['commentCount'] += 1 + count($comment['replies']);
        }

        // Likes
        $creation['likes'] = $creation->likes;

        $respon = [
            'status' => 'succcess',
            'msg' => 'Get Data Creations Berhasil',
            'data' => $creation,
        ];

        return response()->json($respon);
    }

    public function getFollowedCreations($userId)
    {
        $followedId = Follow::where('follower_id', $userId)->pluck('following_id');
        $creations = Creation::whereIn('user_id', $followedId)->get()->sortByDesc('id');
        
        // Add all relationship
        foreach ($creations as $creation) {
            // User
            $creation['user'] = $creation->user;

            // Comments
            $creation['commentCount'] = 0;
            $creation['comments'] = $creation->comments;
            foreach ($creation['comments'] as $comment) {
                $comment['user'] = $comment->user;

                $comment['replies'] = $comment->replies;
                foreach ($comment['replies'] as $reply) {
                    $reply['user'] = $reply->user;
                }

                $creation['commentCount'] += 1 + count($comment['replies']);
            }

            // Likes
            $creation['likes'] = $creation->likes;
        }

        $respon = [
            'status' => 'succcess',
            'msg' => 'Get Data Creations Berhasil',
            'data' => $creations,
        ];

        return response()->json($respon);
    }

    public function getLikedCreations($userId)
    {
        $likes = Like::where('user_id', $userId)->pluck('creation_id');
        $creations = Creation::whereIn('id', $likes)->get();
        
        // Add all relationship
        foreach ($creations as $creation) {
            // User
            $creation['user'] = $creation->user;

            // Comments
            $creation['commentCount'] = 0;
            $creation['comments'] = $creation->comments;
            foreach ($creation['comments'] as $comment) {
                $comment['user'] = $comment->user;

                $comment['replies'] = $comment->replies;
                foreach ($comment['replies'] as $reply) {
                    $reply['user'] = $reply->user;
                }

                $creation['commentCount'] += 1 + count($comment['replies']);
            }

            // Likes
            $creation['likes'] = $creation->likes;
        }

        $respon = [
            'status' => 'succcess',
            'msg' => 'Get Data Creations Berhasil',
            'data' => $creations,
        ];

        return response()->json($respon);
    }

    public function getSearchedCreations($q) {
        // Split search keywords
        $searchKeywords = explode(' ', $q);

        // Redirect if there's no search input
        if (
            count($searchKeywords) == 1 &&
            $searchKeywords[0] == ''
        ) {
            return redirect('/');
        }

        // Parsing the @by:username query
        $artist = preg_grep('/@by:(\S)+/', $searchKeywords);
        if ($artist) {
            $artist = preg_split('/:/', $artist[0]);
            $artist = User::where('username', $artist[1])->first()->id ?? false;

            // Removing the @by:username query from $searchKeywords
            $searchKeywords = preg_filter('/^(?!@by:)\S+$/', '$0', $searchKeywords);
        }

        // Get all creations
        $creations = Creation::get();

        // Filtering creations by search input
        foreach ($searchKeywords as $keyword) {
            $creations = $creations
                ->toQuery()
                ->where('keywords', 'like', '% ' . $keyword . ' %')
                ->orWhere('keywords', 'like', '% ' . $keyword)
                ->orWhere('keywords', 'like', $keyword . '%')
                ->orWhere('title', 'like', '%' . $keyword . '%')
                ->get();
        }

        // Filter creations by artist (if specified)
        if ($artist) {
            $creations = $creations
                ->toQuery()
                ->where('user_id', $artist)
                ->get();
        }

        // Add all relationship
        foreach ($creations as $creation) {
            // User
            $creation['user'] = $creation->user;

            // Comments
            $creation['commentCount'] = 0;
            $creation['comments'] = $creation->comments;
            foreach ($creation['comments'] as $comment) {
                $comment['user'] = $comment->user;

                $comment['replies'] = $comment->replies;
                foreach ($comment['replies'] as $reply) {
                    $reply['user'] = $reply->user;
                }

                $creation['commentCount'] += 1 + count($comment['replies']);
            }

            // Likes
            $creation['likes'] = $creation->likes;
        }

        $respon = [
            'status' => 'succcess',
            'msg' => 'Get Data Creations Berhasil',
            'data' => $creations,
        ];

        return response()->json($respon);
    }
}
