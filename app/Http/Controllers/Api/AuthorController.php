<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AuthorResource::collection(
            Author::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'email'=> 'required',
            'address'=> 'required',
            'sales' => 'required|numeric',
        ]);
        try{
            DB::beginTransaction();
            if($author=Author::create($data))
                DB::commit(); 
        }catch(QueryException | Exception | \Throwable $e){
            DB::rollBack();
        }
        return response(new AuthorResource($author),201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'email'=> 'required',
            'address'=> 'required',
            'sales' => 'required|numeric',
        ]);
        try{
            DB::beginTransaction();
            if($author->update($data))
                DB::commit(); 
        }catch(QueryException | Exception | \Throwable $e){
            DB::rollBack();
        }
        return new AuthorResource($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response("",204);
    }
}
