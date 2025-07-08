<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    // อ่านข้อมูลหนังสือ (พร้อม Pagination)
    public function index()
    {
        $books = Book::paginate(10); // หรือ Book::all();

        return response()->json($books);
    }

    // สร้างหนังสือใหม่
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'nullable|integer',
            'genre' => 'nullable|string|max:100',
        ]);

        $book = Book::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return response()->json($book, 201);
    }


    // แสดงหนังสือ 1 เล่ม
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    // แสดงฟอร์มแก้ไขหนังสือ
    // public function edit($id)
    // {
    //     $book = Book::findOrFail($id);
    //     return view('books.edit', compact('book'));
    // }

    // อัปเดตหนังสือ
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        if ($book->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'published_year' => 'nullable|integer',
            'genre' => 'nullable|string|max:100',
        ]);

        $book->update($validated);

        return response()->json($book);
    }

    // ลบหนังสือ
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}
