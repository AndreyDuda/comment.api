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
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $comment = Comment::new(
            $request->user_id,
            $request->text,
            $request->parent_id
        );

        if ($comment) {
            return response()->json(CommentResource::collection($comment), 200);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if ($comment->update($request->all())) {
            return response()->json(CommentResource::collection($comment), 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment  $comment
     * @return CommentResource
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->delete()) {
            //return response()->json(['success' => 'ok'], 204);
            return new CommentResource($comment);
        }

        return response()->json(['error' => 'Error'], 400);
    }
}
