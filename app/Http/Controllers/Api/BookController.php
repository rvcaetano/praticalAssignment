<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
     
    public function index()
    {
        return BookResource::collection(
            Book::all()
        );
    }


    public function store(StoreBookRequest $request)
    {
        $data = $request->validate([
            'title'=> 'required|string',
            'author_id' => 'required',
            'publisher' => 'required|string',
            'published_at'=> 'required|date',
            'sales'=> 'required|numeric',
        ]);
        try{
            DB::beginTransaction();
            if($book=Book::create($data))
                DB::commit(); 
        }catch(QueryException | Exception | \Throwable $e){
            DB::rollBack();
        }
        return response(new BookResource($book),201);
    }


    public function show(Book $book)
    {
        return new BookResource($book);
    }


    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validate([
            'title'=> 'required|string',
            'author_id' => 'required|integer',
            'publisher' => 'required|string',
            'published_at'=> 'required|date',
            'sales'=> 'required|numeric',
        ]);
        try{
            DB::beginTransaction();
            if($book->update($data))
                DB::commit(); 
        }catch(QueryException | Exception | \Throwable $e){
            DB::rollBack();
        }
        return new BookResource($book);
    }

  
    public function destroy(Book $book)
    {
        $book->delete();
        return response("",204);
    }
}
