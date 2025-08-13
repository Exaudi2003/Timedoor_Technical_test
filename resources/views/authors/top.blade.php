@extends('layouts.app')

@section('content')
<h1>Top 10 Most Famous Authors (Votes > 5)</h1>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Author</th>
            <th>Voters (>5)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($authors as $i => $a)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $a->name }}</td>
                <td>{{ $a->voters_gt5 }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
