<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * 画像ファイルがファイル形式であること、拡張子の限定を行う
     *
     * @return array
     */
    public function rules()
    {
        return [
            'note_title' => ['required', 'max:100'],
            'content' => ['required', 'max:1000'],
            'file_name' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif'],
        ];
    }

    public function attributes()
    {
        return [
            'note_title' => 'タイトル',
            'content' => '本文',
            'file_name' => '画像',
        ];
    }
}
