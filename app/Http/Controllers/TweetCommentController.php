<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Auth;
use Illuminate\Http\Request;

class TweetCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tweet $tweet)
    {
        $this->validate($request, [
            'content' => ['required', 'min:10'],
        ]);

        $tweet->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $request->content
        ]);

        return redirect()->route('tweet.show', $tweet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        return view('comment.edit', [
            'tweet' => $tweet,
            'comment' => $comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet, Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $this->validate($request, [
            'content' => ['required', 'min:10']
        ]);

        $comment->update($request->only('content'));

        return redirect()->route('tweet.show', $tweet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet, Comment $comment)
    {
        if (Auth::id() == $comment->user_id || Auth::id() == $tweet->user_id) {
            $comment->delete();
        } else {
            abort(403);
        }

        return redirect()->route('tweet.show', $tweet);
    }
}
