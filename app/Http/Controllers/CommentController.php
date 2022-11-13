<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Creation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store comment to database
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'content' => 'required',
            'creation_id' => 'required',
            'parent_id' => 'nullable',
        ]);

        // Create comment
        Comment::create([
            'user_id' => Auth::user()->id,
            'creation_id' => $request->get('creation_id'),
            'parent_id' => $request->get('parent_id'),
            'content' => $request->get('content'),
        ]);

        // Redirect
        return redirect()->route('creationShow', [$request->get('creation_id')]);
    }

    // Delete comment (not entirely, just nullify some columns)
    public function destroy($id, $comment_id)
    {
        // Find comment by id
        $comment = Comment::where('id', $comment_id)->firstOrFail();

        // Find creation by id
        $creation = Creation::where('id', $id)->firstOrFail();

        // Determine who deleted this comment
        if (Auth::user()->id == $creation->user_id && Auth::user()->id != $comment->user_id) {
            $deletedBy = 'poster';
        } else if (Auth::user()->role == 'admin') {
            $deletedBy = 'admin';
        } else {
            $deletedBy = 'user';
        }

        // Nullify id and content, and determine who deleted it
        $comment->user_id = null;
        $comment->content = null;
        $comment->deleted_by = $deletedBy;
        $comment->save();

        // Redirect
        return redirect()->route('creationShow', $id);
    }
}
