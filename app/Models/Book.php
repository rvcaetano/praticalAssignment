<?php

namespace App\Models;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Book extends Model
{
    use HasFactory;

    protected $table= "books";
    public $timestamps = false;
    protected $fillable = [
        "id",
        "author_id",
        "title",
        "publisher",
        "published_at",
        "sales",
    ];

    public function author(){
        return $this->belongsTo(Author::class);
    }
}
