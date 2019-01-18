<?php

namespace App\Model\Comment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * @package App\Model\Comment
 * @property int $id
 * @property string $user_name
 * @property int|null $parent_id
 * @property string $text
 *
 * @property Comment $parent
 * @property Comment[] $children
 */
class Comment extends Model
{
    use SoftDeletes;

    const TABLE = 'comments';

    const PROP_ID        = 'id';
    const PROD_USER_NAME = 'user_name';
    const PROP_PARENT_ID = 'parent_id';
    const PROP_TEXT      = 'text';
    const CREATED_AT     = 'created_at';
    const UPDATED_AT     = 'updated_at';
    const DELETED_AT     = 'deleted_at';

    protected $table = self::TABLE;
    protected $dates = [self::DELETED_AT];

    protected $fillable = [
        self::PROD_USER_NAME,
        self::PROP_PARENT_ID,
        self::PROP_TEXT
    ];

    public function parent()
    {
        return $this->belongsTo(Comment::class, self::PROP_PARENT_ID, self::PROP_ID);
    }

    public function children()
    {
        return $this->hasmany(Comment::class, self::PROP_PARENT_ID, self::PROP_ID);
    }

}
