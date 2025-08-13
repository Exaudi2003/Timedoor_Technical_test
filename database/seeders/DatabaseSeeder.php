<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) Authors (1000)
        $authors = [];
        $now = now();
        for ($i = 0; $i < 1000; $i++) {
            $authors[] = [
                'name' => 'Author ' . Str::random(8),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('authors')->insert($authors);

        // 2) Categories (3000)
        $categories = [];
        for ($i = 0; $i < 3000; $i++) {
            $categories[] = [
                'name' => 'Category ' . Str::random(8),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('categories')->insert($categories);

        // Ambil ID authors & categories untuk assign ke books
        $authorIds = DB::table('authors')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        // 3) Books (100k) → dibagi chunk supaya hemat memory
        $totalBooks = 100000;
        $bookChunk = 5000;
        for ($i = 0; $i < $totalBooks; $i += $bookChunk) {
            $rows = [];
            for ($j = 0; $j < $bookChunk && ($i + $j) < $totalBooks; $j++) {
                $rows[] = [
                    'author_id' => $authorIds[array_rand($authorIds)],
                    'category_id' => $categoryIds[array_rand($categoryIds)],
                    'title' => 'Book ' . Str::random(12),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('books')->insert($rows);
        }

        // Ambil semua book_id untuk ratings
        $bookIds = DB::table('books')->pluck('id')->toArray();

        // 4) Ratings (500k) → chunk lebih kecil biar aman
        $totalRatings = 500000;
        $ratingChunk = 5000;
        for ($i = 0; $i < $totalRatings; $i += $ratingChunk) {
            $rows = [];
            for ($j = 0; $j < $ratingChunk && ($i + $j) < $totalRatings; $j++) {
                $rows[] = [
                    'book_id' => $bookIds[array_rand($bookIds)],
                    'score' => rand(1, 10),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('ratings')->insert($rows);
        }
    }
}
