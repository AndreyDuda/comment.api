<?php

namespace App\Http\Resources\Comment;

use App\Model\Comment\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            Comment::PROP_ID        => $this->id,
            Comment::PROP_PARENT_ID => $this->parent_id,
            Comment::PROP_USER_NAME => $this->user_name,
            Comment::PROP_TEXT      => $this->text,
            Comment::CREATED_AT     => $this->created_at,
            Comment::UPDATED_AT     => $this->updated_at
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'author_url' => 'Duda'
        ];
    }
}
