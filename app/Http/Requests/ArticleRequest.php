<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\Repositories\Article\ArticleInterface;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
        $this->categories = $this->categories ?? app(ArticleInterface::class)->defaultCategoryIds();
        $this->user_id = currentUser()->id();

        return [
            'title'         =>  'required',
            'content'       =>  'required',
        ];
    }
}
