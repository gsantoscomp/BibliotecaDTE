<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Publisher extends Model
{
    protected $primaryKey = "pub_id";

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
