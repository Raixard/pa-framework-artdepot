<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // Like a creation
    public function store($id)
    {
        Like::create([
            'user_id' => Auth::user()->id,
            'creation_id' => $id,
        ]);

        return redirect()->route('creationShow', $id);
    }

    // Remove a creation
    public function destroy($id)
    {
        $like = Like::where('creation_id', $id)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        $like->delete();

        return redirect()->route('creationShow', $id);
    }
}
