<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BooksController
{
    /**
     * GET /books
     * @return array
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * GET /book/{id}
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id)
    {
        try{
            return Book::findOrFail($id);
        }catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Book not found'
                ]
            ], 404);
        }
    }

    /**
     * Post /books
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json(['created' => true], 201, [
            'Location' => route('books.show', ['id' => $book->id])
        ]);
    }

    /**
     * Update /books/{id}
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Book not found'
                ]
            ], 404);
        }


        $book->fill($request->all());
        $book->save();

        return $book;
    }

    /**
     * DELETE /books/{id}
     * @param $id
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        try{
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e)
        {
            return response()->json([
                'error' => [
                    'message' => 'Book not found'
                ]
            ], 404);
        }
        $book->delete();

        return response(null, 204);
    }
}