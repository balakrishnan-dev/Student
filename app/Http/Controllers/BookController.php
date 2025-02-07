<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function getId(Request $request, $Id){
        $bookid = Book::find($Id);
        return response()->json($bookid);
    }
    public function index(Request $request){
        $books = Book::all();
        return response()->json($books, 201);
    }

    public function store(Request $request){
        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    public function update(Request $request, $id){
        $book = Book::find($id);
        if(!$book){
            return response()->json(['message'=>'Book Not Found'], 404);
        }
        $book->update($request->all());
        return response()->json($book,201);
    }

    public function delete(Request $request, $id){
        $book = Book::find($id);
        if(!$book){
            return response()->json(['message'=>'Book Not Found'], 404);
        }
        $result = $book->delete();
        return response()->json([$result => 'Data Deleted Successfully'], 201);
    }

    public function deleteAll(Request $request){
        Book::truncate();
        return response()->json(['message' => 'Data Deleted Successfully'], 201);
    }
}