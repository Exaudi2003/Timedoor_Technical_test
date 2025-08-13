@extends('layouts.app')

@section('content')
<h1>Books (Top by Average Rating)</h1>

<form method="get" action="{{ route('books.index') }}">
    <label>Show:
        <select name="show" onchange="this.form.submit()">
            @foreach($showOptions as $opt)
                <option value="{{ $opt }}" {{ $perPage == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
        </select>
    </label>

    <label style="margin-left: 1rem;">Search:
        <input type="text" name="q" value="{{ $search }}" placeholder="Book or Author">
    </label>

    <button type="submit">Filter</button>
</form>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Avg Rating</th>
            <th>Voters</th>
        </tr>
    </thead>
    <tbody>
        @forelse($books as $idx => $b)
            <tr>
                <td>{{ ($books->currentPage() - 1) * $books->perPage() + $idx + 1 }}</td>
                <td>{{ $b->title }}</td>
                <td>{{ $b->author->name }}</td>
                <td>{{ number_format((float)$b->avg_score, 2) }}</td>
                <td>{{ $b->voters }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div>
    {{ $books->links() }}
</div>
@endsection
