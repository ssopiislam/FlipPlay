<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($id),
            ],

            'type' => [
                'sometimes',
                'required',
                'in:Anime,Manga',
            ],

            'genre' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],

            'episodes' => [
                'sometimes',
                'nullable',
                'required_if:type,Anime',
                'integer',
                'min:1',
            ],

            'chapters' => [
                'sometimes',
                'nullable',
                'required_if:type,Manga',
                'integer',
                'min:1',
            ],
        ];
    }
}
