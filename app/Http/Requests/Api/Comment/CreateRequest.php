<?php

namespace App\Http\Requests\Api\Comment;

use App\Model\Comment\Comment;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Comment::PROP_USER_NAME => 'required|string|max:255',
            Comment::PROP_TEXT      => 'required|string|min:3',
            Comment::PROP_PARENT_ID => 'nullable|integer'
        ];
    }
}
