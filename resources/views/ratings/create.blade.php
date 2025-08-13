@extends('layouts.app')

@section('content')
<h1>Input Rating</h1>

{{-- Pilih Author --}}
<form method="get" action="{{ route('ratings.create') }}">
    <label>Author:
        <select name="author_id" onchange="this.form.submit()">
            <option value="">-- Pick Author --</option>
            @foreach($authors as $a)
                <option value="{{ $a->id }}" {{ (string)$a->id === (string)$selectedAuthor ? 'selected' : '' }}>
                    {{ $a->name }}
                </option>
            @endforeach
        </select>
    </label>
</form>

{{-- Pilih Book & Rating --}}
@if($selectedAuthor)
<form method="post" action="{{ route('ratings.store') }}">
    @csrf
    <input type="hidden" name="author_id" value="{{ $selectedAuthor }}">

    <label>Book:
        <select name="book_id" required>
            @foreach($books as $b)
                <option value="{{ $b->id }}">{{ $b->title }}</option>
            @endforeach
        </select>
    </label>

    <label style="margin-left: 1rem;">Rating:
        <select name="score" required>
            @foreach($ratings as $r)
                <option value="{{ $r }}">{{ $r }}</option>
            @endforeach
        </select>
    </label>

    <button type="submit" style="margin-left: 1rem;">Submit</button>
</form>
@endif

{{-- Error messages --}}
@error('author_id') <p class="error">{{ $message }}</p> @enderror
@error('book_id')   <p class="error">{{ $message }}</p> @enderror
@error('score')     <p class="error">{{ $message }}</p> @enderror
@endsection
