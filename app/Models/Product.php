<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'sku',
        'price',
        'description'
    ];

    public function moreInfo()
    {
        return $this->hasOne(MoreInfo::class);
    }
}
