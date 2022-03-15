<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Auth;
use Redirect;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        $reaction = new Reaction;
        $reaction = Reaction::where('idComment', $request->id)->where('idUser', Auth::user()->id)->first();
        if (!$reaction) {
            $newReaction = new Reaction;
            $newReaction->create(['idComment' => $request->id, 'idUser' => Auth::user()->id, 'tipo' => 1]);
        }  else if ($reaction->tipo != '1'){
            $reaction->tipo = 1;
            $reaction->save();
        }
        return redirect()->back();
        
    }

    public function dislike(Request $request)
    {
        $reaction = new Reaction;
        $reaction = Reaction::where('idComment', $request->id)->where('idUser', Auth::user()->id)->first();
        if (!$reaction) {
            $newReaction = new Reaction;
            $newReaction->create(['idComment' => $request->id, 'idUser' => Auth::user()->id, 'tipo' => 1]);
        }  else if ($reaction->tipo != '0'){
            $reaction->tipo = 0;
            $reaction->save();
        }
        return redirect()->back();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comentario = new Comment;
        $comentario = $comentario->create(['idUser' => Auth::user()->id, 'idPost' => $request->id, 'comentario' => $request->comentario]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = new Comment;
        $comment = Comment::where('id', $id)->with('owner')->first();
        if ($comment) {
            if (($comment->owner->id == Auth::user()->id) || (Auth::user()->type == 2)) {
                $comment->delete();
            }
        }
        return Redirect::back();
    }
}
