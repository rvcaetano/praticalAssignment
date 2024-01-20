<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Author extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table= "authors";
    protected $fillable = [
        "id",
        "name",
        "age",
        "email",
        "address",
        "sales",
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }
}
