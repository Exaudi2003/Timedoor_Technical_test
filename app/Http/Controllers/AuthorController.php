<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function top()
    {
        $authors = Author::query()
            ->select('authors.*')
            ->selectSub(function ($q) {
                $q->from('books')
                    ->join('ratings', 'ratings.book_id', '=', 'books.id')
                    ->whereColumn('books.author_id', 'authors.id')
                    ->where('ratings.score', '>', 5)
                    ->selectRaw('COUNT(ratings.id)');
            }, 'voters_gt5')
            ->orderByDesc('voters_gt5')
            ->orderBy('authors.id')
            ->limit(10)
            ->get();

        return view('authors.top', compact('authors'));
    }
}
