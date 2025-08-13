<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;

class RatingController extends Controller
{
    public function create(Request $request)
    {
        $authors = Author::orderBy('name')->get(['id', 'name']);
        $selectedAuthor = $request->input('author_id');
        $books = collect();

        if ($selectedAuthor) {
            $books = Book::where('author_id', $selectedAuthor)
                         ->orderBy('title')
                         ->get(['id', 'title']);
        }

        $ratings = range(1, 10);

        return view('ratings.create', compact('authors', 'books', 'selectedAuthor', 'ratings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'author_id' => ['required', 'exists:authors,id'],
            'book_id'   => ['required', 'exists:books,id'],
            'score'     => ['required', 'integer', 'between:1,10'],
        ]);

        $book = Book::where('id', $data['book_id'])
                    ->where('author_id', $data['author_id'])
                    ->firstOrFail();

        Rating::create([
            'book_id' => $book->id,
            'score'   => $data['score'],
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Rating submitted');
    }
}
