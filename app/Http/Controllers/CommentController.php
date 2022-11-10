<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

        // Nullify id and content
        $comment->update([
            'user_id' => null,
            'content' => null,
        ]);

        // Redirect
        return redirect()->route('creationShow', $id);
    }
}
