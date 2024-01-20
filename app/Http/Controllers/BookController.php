<?php
/*
namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class BookController extends Controller
{
    public function create(){
        $authors = Author::all();
        return view("book",[
            'authors' => $authors,
            'action' => 'create'
        ]);
    }

    public function store(Request $request){
        
        $data = $request->validate([
            'title'=> 'required|string',
            'author_id' => 'required|integer',
            'publisher' => 'required|string',
            'published_at'=> 'required|date',
            'sales'=> 'required|numeric',
        ]);
        
        try {
            DB::beginTransaction();
            if($book=Book::create([
                'title' => $data['title'],
                'author_id' => intval($data['author_id']),
                'publisher'=> $data['publisher'],
                'published_at'=> $data['published_at'],
                'sales'=> $data['sales'],
            ])){
                DB::commit();
                session()->flash('success','Successfully created!');
                return redirect('/');
            }
        }catch(QueryException | Exception | \Throwable $e){
            DB::rollBack();
            Log::error($e->getMessage() . 'at line' . $e->getLine());
            return redirect()->back()->withError('Create error!');
        }
    }
    public function show($id){
        $book = Book::findOrFail($id);
        return view('book',[
            'book'=> $book,
            'action'=> 'show'
        ]);
    }

    public function edit($id){
        $book = Book::findOrFail($id);
        $authors = Author::all();
        return view('book',[
            'book' => $book,
            'action' => 'edit',
            'authors' => $authors
        ]);
    }

    public function update(Request $request, $id){
    
        $data = $request->validate([
            'title'=> 'required|string',
            'author_id' => 'required|integer',
            'publisher' => 'required|string',
            'published_at'=> 'required|date',
            'sales'=> 'required|numeric',
        ]);
        try{
            $book = Book::findOrFail($id);
            if($book->update([
                'title' => $data['title'],
                'author_id' => intval($data['author_id']),
                'publisher'=> $data['publisher'],
                'published_at'=> $data['published_at'],
                'sales'=> $data['sales']
            ])){
                DB::commit();
                session()->flash('success','Successfully created!');
                return redirect('/');
            }
        }catch(QueryException | Exception | \Throwable $e){
            DB::rollBack();
            Log::error($e->getMessage() . 'at line' . $e->getLine());
            return redirect()->back()->withError('Update error!');
        }
    }

    public function destroy($id){
        try{
            DB::beginTransaction();
            if(Book::findOrfail($id)->delete()){
                DB::commit();
                return redirect('/');
            }
        }
        catch(QueryException | \Throwable $e){
            DB::rollBack();
            Log::error($e->getMessage() . 'at line' . $e->getLine());
            return redirect()->back()->withError('Delete error!');
        }
    }

}
