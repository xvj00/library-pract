<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:10024',
            'author_id'  => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Название книги обязательно для заполнения.',
            'description.required' => 'Описание книги обязательно для заполнения.',
            'author_id.required' => 'Выберите автора.',
        ];
    }
}
