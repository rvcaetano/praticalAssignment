<?php
/*
namespace App\Http\Controllers;

use Exception;
use App\Models\Author;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\AuthorResource;
use Illuminate\Database\QueryException;

class AuthorController extends Controller
{
    public function create(){
        return view("author",[
            'author' => [],
            'action' => 'create'
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'email'=> 'required',
            'address'=> 'required',
            'sales' => 'required|numeric',
        ]);
        try{
            DB::beginTransaction();
        
            if($author=Author::create([
                'name' => $data['name'],
                'age' => $data['age'],
                'email'=> $data['email'],
                'address'=> $data['address'],
                'sales'=> $data['sales'],
            ])){
                DB::commit();
                session()->flash('success','Successfully created!');
                return redirect('/');
            }
        }catch(QueryException | Exception | \Throwable $e){
            DB::rollBack();
            return redirect('/')->withError('Create error!');
        }
    }

    public function show($id){
        $author = Author::findOrFail($id);

        return view("author",[
            'author' => $author,
            'action' => 'show'
        ]);
    }

    public function edit($id){
        $author = Author::findOrFail($id);
        return view("author",[
            'author' => $author,
            'action' => 'edit'
        ]);
    }

    public function update(Request $request, $id){
    
        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'email'=> 'required',
            'address'=> 'required',
            'sales' => 'required|numeric',
        ]);
        
        try{
            $author = Author::findOrFail($id);

            if($author->update([
                'name' => $data['name'],
                'age' => $data['age'],
                'email'=> $data['email'],
                'address'=> $data['address'],
                'sales'=> $data['sales'] ?? 0,
            ])){
                DB::commit();
                session()->flash('success','Successfully updated!');
                return redirect('/');
            }
        }catch(QueryException | Exception | \Throwable $e){
            DB::rollBack();
            return redirect('/')->withError('Update error!');
        }
    }

    public function destroy($id){
        try{
            DB::beginTransaction();
            if(Author::findOrfail($id)->delete()){
                DB::commit();
                return redirect('/');
            }
        }
        catch(QueryException | \Throwable $e){
            DB::rollBack();
            Log::error($e->getMessage() . 'at line' . $e->getLine());
            return redirect()->back();
        }
    }
}
