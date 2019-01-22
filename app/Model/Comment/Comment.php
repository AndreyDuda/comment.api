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
    const PROP_USER_NAME = 'user_name';
    const PROP_PARENT_ID = 'parent_id';
    const PROP_TEXT      = 'text';
    const CREATED_AT     = 'created_at';
    const UPDATED_AT     = 'updated_at';
    const DELETED_AT     = 'deleted_at';

    protected $table = self::TABLE;
    protected $dates = [self::DELETED_AT];

    protected $fillable = [
        self::PROP_USER_NAME,
        self::PROP_PARENT_ID,
        self::PROP_TEXT
    ];

    protected $hidden = [
        self::DELETED_AT
    ];

    public function parent()
    {
        return $this->belongsTo(Comment::class, self::PROP_PARENT_ID, self::PROP_ID);
    }

    public function children()
    {
        return $this->hasmany(Comment::class, self::PROP_PARENT_ID, self::PROP_ID);
    }

    public function edit($user_name, $text)
    {

        $this->user_name = $user_name;
        $this->text = $text;

        return $this->save();
    }


    public static function new($user_name, $text, $parent_id = null): self
    {
        return static::create([
            self::PROP_USER_NAME => $user_name,
            self::PROP_TEXT      => $text,
            self::PROP_PARENT_ID => $parent_id
        ]);
    }

    public static function getOne($id)
    {
        return static::findOrFail($id);
    }

    public static function getAll()
    {
        return static::orderBy('created_at', 'DESC')->all();
    }

    public static function getPaginate($count)
    {
        return static::orderBy('created_at', 'DESC')->paginate($count);
    }


}
