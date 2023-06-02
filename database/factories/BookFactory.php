<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
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
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'thumbnail' => '/thumbnails/c4MegLxeF1MqS6Euk32XC5zmcx8cTysiaoGhVfik.png',
            'pdf' => '/books/TQOpuY7h5hVv1I5lGyNV3qxy9qgQWAJUSQTxnQpr.epub',
            'user_id' => rand(1, 50),
            'category_id' => rand(1, 10),
        ];
    }
}
