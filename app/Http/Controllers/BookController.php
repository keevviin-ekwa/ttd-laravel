<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request){
        Book::create($this->validateDate($request));
    }
   public function update($book, Request $request){
        $book= Book::find($book);
        $book->update($this->validateDate($request));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateDate(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',]);
        return $data;
    }
}
