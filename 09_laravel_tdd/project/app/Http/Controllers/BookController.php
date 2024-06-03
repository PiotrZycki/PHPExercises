<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\BookCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Mixed
    {
        if(!Auth::check()) {
            return redirect('/login');
        }
        #return view('books.index')->with('books', Book::all());
        return view('books.index', ['books' => Book::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookCreateRequest $request): RedirectResponse
    {
        $book = new Book();
        $book->isbn = $request->input('isbn');
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->save();
        return redirect()->route('books.show', $book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        return view('books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        return view('books.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookCreateRequest $request, Book $book): RedirectResponse
    {
        $record = Book::find($book->id);
        if($record) {
            $record->isbn = $request->input('isbn');
            $record->title = $request->input('title');
            $record->description = $request->input('description');
            $record->save();
        }
        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('books.index', ['books' => Book::all()]);
    }
}
