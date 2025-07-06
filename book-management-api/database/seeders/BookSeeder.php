<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Book::create([
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'published_year' => 2008,
            'genre' => 'Programming'
        ]);

        Book::create([
            'title' => 'Atomic Habits',
            'author' => 'James Clear',
            'published_year' => 2018,
            'genre' => 'Self-help'
        ]);
    }
}
