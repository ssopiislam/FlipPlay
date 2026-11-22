<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:media,title',
            ],

            'type' => [
                'required',
                'in:Anime,Manga',
            ],

            'genre' => [
                'required',
                'string',
                'max:255',
            ],

            'episodes' => [
                'nullable',
                'required_if:type,Anime',
                'integer',
                'min:1',
            ],

            'chapters' => [
                'nullable',
                'required_if:type,Manga',
                'integer',
                'min:1',
            ],
        ];
    }
}
