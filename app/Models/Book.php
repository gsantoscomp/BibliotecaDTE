<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Publisher;
use App\Models\Loan;

class Book extends Model
{
    protected $primaryKey = "bk_id";

    protected $fillable = [
        'bk_title', 'bk_author', 'bk_publisher', 'bk_owner', 'bk_description'
    ];
    protected $hidden = [
        'remember_token'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
