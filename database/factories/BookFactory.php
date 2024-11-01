<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Edition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake() -> sentence(1),
            'description' => fake() -> paragraph(5),
            'edition_id' => Edition::inRandomOrder()->first()->id,
        ];

    }
//    public function configure()
//    {
//        return $this->afterCreating(function (Book $book) {
//            $images = [
//                'https://cdn.culture.ru/images/8002dfd6-41ef-5f44-9659-8f168eda9021',
//                'https://cdnstatic.rg.ru/uploads/images/2024/02/20/istock-949118068_c29.jpg',
//                'https://cdn.culture.ru/images/a7d5c2ba-87af-51f8-9305-034fa71dd4a1',
//                'https://cdn.culture.ru/images/041579c0-ea38-5979-9182-90aa1ffcb557',
//                'https://cdn.culture.ru/images/ffe3561a-dc50-5577-8223-f50d1fda5b99'
//            ];
//
//            $book->addMediaFromUrl($images[array_rand($images)])
//                ->toMediaCollection('book_images');
//        });
//    }
}
