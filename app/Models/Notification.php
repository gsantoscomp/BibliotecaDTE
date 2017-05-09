<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Book;

class Notification extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function book()
    {
        return $this->hasOne(Book::class, 'bk_id', 'book_id');
    }

}
