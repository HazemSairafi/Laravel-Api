<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Student;

class BookController extends Controller
{
    public function createBook(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
        ]);

        $book = new Book();
        $book->student_id = auth()->user()->id;
        // $book->student_id = $student_id;
        $book->name = $request->name;
        $book->desc = $request->desc;
        $book->price = $request->price;
        $book->save();

        $author = auth()->user()->id;
        $books = Student::find($author);

        return response()->json([
            'status'=>true,
            'message'=>$request->name,
            'author'=>$books->name,
        ]);
    }

    public function ListBook()
    {
        $books = Book::all();
        return response()->json([
            'status'=>true,
            'message'=>'list',
            'data'=>$books,
        ]);
    }

    public function authorBook()
    {
        $author = auth()->user()->id;
        $books = Student::find($author)->book;
        return response()->json([
            'status'=>true,
            'message'=>'list',
            'data'=>$books,
        ]);
    }

    public function SingleBook($book_id)
    {
        $author_id = auth()->user()->id;
        $books = Student::find($author_id);
        
        if(isset($book_id)){
            $book = Book::find($book_id);
            return response()->json([
                "status" => true,
                "message" => "Book data found",
                "data" => $book,
                "author" => $books->name,
            ]);}
            else{
                return response()->json([
                    "status" => false,
                    "message" => "Book not found",
                ]);
            }
        
    }

    public function updateBook(Request $request,$book_id)
    {
        $author_id = auth()->user()->id;

        if(Book::where($author_id,$book_id)){
        $book = Book::find($book_id);
            $book->name = isset($request->name) ? $request->name : $book->name ;
            $book->desc = isset($request->desc) ? $request->desc : $book->desc ;
            $book->price = isset($request->price) ? $request->price : $book->price ;
        $book->save();
        return response()->json([
            'status'=>true,
            'data'=>'yes',
        ]);
        }else{
            return response()->json(['status'=>false,]);
        }
    }



    public function deleteBook($book_id)
    {
        $author_id = auth()->user()->id;
        if(Book::where($author_id,$book_id)){
        $book = Book::find($book_id)->delete();
            return response()->json([
                "status" => true,
                "message" => "Book deleated",
            ]);
        }
        else{
            return response()->json([
                "status" => false,
                "message" => "Book deleated no",
            ]);
        }
            
    }
}
