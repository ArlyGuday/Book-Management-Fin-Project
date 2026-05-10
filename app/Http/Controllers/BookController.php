<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Show all books
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $books = Book::all();
    } else {
            $books = auth()->user()->books;
        }
        return view('books.index', compact('books'));
    }

    // Show create form
    public function create()
    {
        return view('books.create');
    }

    // Store book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

        Book::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    // Show book details
    public function show(Book $book)
    {
        $this->authorize('view', $book);

        return view('books.show', compact('book'));
    }

    // Show edit form
    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        return view('books.edit', compact('book'));
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

        $book->update($request->only(['title', 'author', 'description']));

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    // Delete book
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        $book->delete();

        return back()->with('success', 'Book deleted successfully');
    }
}