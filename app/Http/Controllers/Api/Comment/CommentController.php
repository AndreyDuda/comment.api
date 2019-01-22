<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Requests\Api\Comment\CreateRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Model\Comment\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($comments = Comment::getPaginate(15)) {
            return CommentResource::collection($comments);
        }

        return response()->json(['error' => 'Error'], 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest  $request
     * @return CommentResource
     */
    public function store(Request $request)
    {
        $comment = Comment::new(
            $request->input('user_name'),
            $request->input('text')
        );

        if ($comment) {
            return new CommentResource($comment);
        }

        return response()->json(['error' => 'Error'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  Comment  $comment
     * @return CommentResource
     */
    public function show($id)
    {
        if ($comment = Comment::getOne($id)) {
            return new CommentResource($comment);
        }

        return response()->json(['error' => 'Error'], 400);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CommentResource
     */
    public function update(Request $request)
    {
        $comment = Comment::getOne($request->input('id'));
        /** @var Comment $comment */

        $comment = $comment->edit(
            $request->input('user_name'),
            $request->input('text')
        );
        if ($comment) {
            return new CommentResource($comment);
        }

        return response()->json(['error' => 'Error'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment  $comment
     * @return CommentResource
     */
    public function destroy($id)
    {
        $comment = Comment::getOne($id);
        if ($comment->delete()) {
            return new CommentResource($comment);
        }

        return response()->json(['error' => 'Error'], 400);
    }
}
