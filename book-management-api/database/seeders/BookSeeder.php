<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Book::insert([
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'published_year' => 2008,
                'genre' => 'Programming',
                'user_id' => 1,
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'published_year' => 2018,
                'genre' => 'Self-help',
                'user_id' => 1,
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'author' => 'Andrew Hunt',
                'published_year' => 1999,
                'genre' => 'Programming',
                'user_id' => 1,
            ],
            [
                'title' => 'Deep Work',
                'author' => 'Cal Newport',
                'published_year' => 2016,
                'genre' => 'Productivity',
                'user_id' => 1,
            ],
            [
                'title' => 'The 7 Habits of Highly Effective People',
                'author' => 'Stephen R. Covey',
                'published_year' => 1989,
                'genre' => 'Self-help',
                'user_id' => 1,
            ],
            [
                'title' => 'Start With Why',
                'author' => 'Simon Sinek',
                'published_year' => 2009,
                'genre' => 'Leadership',
                'user_id' => 1,
            ],
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'published_year' => 2011,
                'genre' => 'Business',
                'user_id' => 1,
            ],
            [
                'title' => 'Zero to One',
                'author' => 'Peter Thiel',
                'published_year' => 2014,
                'genre' => 'Business',
                'user_id' => 1,
            ],
            [
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert T. Kiyosaki',
                'published_year' => 1997,
                'genre' => 'Finance',
                'user_id' => 1,
            ],
            [
                'title' => 'Can’t Hurt Me',
                'author' => 'David Goggins',
                'published_year' => 2018,
                'genre' => 'Motivation',
                'user_id' => 1,
            ],
            [
                'title' => 'Ikigai',
                'author' => 'Héctor García',
                'published_year' => 2016,
                'genre' => 'Philosophy',
                'user_id' => 1,
            ],
            [
                'title' => 'Thinking, Fast and Slow',
                'author' => 'Daniel Kahneman',
                'published_year' => 2011,
                'genre' => 'Psychology',
                'user_id' => 1,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'published_year' => 1949,
                'genre' => 'Fiction',
                'user_id' => 1,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'published_year' => 1960,
                'genre' => 'Fiction',
                'user_id' => 1,
            ],
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'published_year' => 1988,
                'genre' => 'Fiction',
                'user_id' => 1,
            ],
        ]);
    }
}
