<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // customer comment
    public function comment(Request $request)
    {
        Comment::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
            'message' => $request->comment
        ]);

        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'action' => 'comment'
        ]);

        return back();
    }

    // Deleting comment
    public function commentDelete($id)
    {
        Comment::where('user_id', $id)->delete();
        return back();
    }
}
