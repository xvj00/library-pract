<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'edition_id' => 'nullable|exists:editions,id', //
            'author_id' => 'nullable|integer|exists:authors,id',
            'genre_id' => 'nullable|array', // Допустим, что жанров можно передавать в виде массива
            'genre_id.*' => 'exists:genres,id', // Проверка каждого жанра в массиве
            'image' => 'nullable|image|max:10024', // Допустим, что вы можете передавать изображение
        ];
    }

    // Опционально: если вы хотите изменить сообщения об ошибках
    public function messages()
    {
        return [
            'title.required' => 'Название книги обязательно для заполнения.',
            'edition_id.exists' => 'Выбранное издание не существует.',
            'author_id.*.exists' => 'Один из выбранных авторов не существует.',
            'genre_id.*.exists' => 'Один из выбранных жанров не существует.',
            'image.image' => 'Файл должен быть изображением.',
            'image.max' => 'Изображение не должно превышать 2MB.',
        ];
    }
}
