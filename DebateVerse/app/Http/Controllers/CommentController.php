<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Debate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //

    public function storeComment(Request $request, Debate $debate)
    {
        $debateId = $debate->id;
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = Comment::create([
            'content' => $request->input('comment'),
            'user_id' => Auth::id(),
            'debate_id' => $debateId,
        ]);

        if ($comment){
            return redirect()->route('home')->with('successResponse', 'Comment Added Successfully');
        }

        return redirect()->back()->with('errorProfile', 'Something Went Wrong');
    }

    public function destroyComment(Comment $comment)
    {
        if (!$comment->user_id == Auth::id()){
            return redirect()->route('home')->with('errorProfile', 'You are not authorized to delete this comment');
        }
        $comment->delete();
        return redirect()->route('home')->with('successResponse', 'Comment Deleted Successfully');
    }

    public function updateComment(Request $request, Comment $comment)
    {
        if (!$comment->user_id == Auth::id()){
            return redirect()->route('home')->with('errorProfile', 'You are not authorized to update this comment');
        }
        $request->validate([
            'comment' => 'required',
        ]);
        $comment->update([
            'content' => $request->input('comment'),
        ]);
        return redirect()->route('home')->with('successResponse', 'Comment Updated Successfully');
    }
}
