<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 22.01.19
 * Time: 6:19
 */

namespace App\UsesCase;


use App\Model\Comment\Comment;

class TreeCase
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function treeComments($model = null)
    {
        $tree = [];
        $model = $model ?? $this->model;
        foreach ($this->model as $item)
        {
            $tree['id'] = $item->id;
            if ($item->children) {

               $tree['children'] = $this->treeComments($item);
            }
        }

        return $tree;
    }
}


