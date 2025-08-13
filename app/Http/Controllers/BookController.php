<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('show', 10);
        if ($perPage < 10 || $perPage > 100 || $perPage % 10 !== 0) {
            $perPage = 10;
        }

        $search = trim((string) $request->input('q', ''));

        $books = Book::query()
            ->select('books.*')
            ->with('author')
            ->withCount(['ratings as voters'])
            ->selectSub(function($q) {
                $q->from('ratings')
                  ->selectRaw('AVG(score)')
                  ->whereColumn('ratings.book_id', 'books.id');
            }, 'avg_score')
            ->when($search !== '', function($q) use ($search) {
                $q->where(function($qq) use ($search) {
                    $qq->where('books.title', 'like', "%{$search}%")
                       ->orWhereHas('author', function($qa) use ($search) {
                           $qa->where('authors.name', 'like', "%{$search}%");
                       });
                });
            })
            ->orderByDesc('avg_score')
            ->orderBy('books.id')
            ->paginate($perPage)
            ->withQueryString();

        $showOptions = range(10, 100, 10);

        return view('books.index', compact('books', 'showOptions', 'perPage', 'search'));
    }
}
