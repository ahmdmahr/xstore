<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prod_id',
        'review'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function product(){
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}
