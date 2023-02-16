<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sellitem(){
        return $this->hasMany(SellItem::class,'sell_id','id');
    }
}
