<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Publisher;
use App\Models\Loan;

class Book extends Model
{
    protected $primaryKey = "bk_id";

    protected $fillable = [
        'bk_title', 'bk_author', 'bk_pub_id', 'bk_owner', 'bk_description'
    ];
    protected $hidden = [
        'remember_token'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'bk_pub_id', 'pub_id');
    }
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
