<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', // Foreign key to Product
        'description',
        'manufacturer',
        'warranty_period',
        'additional_features',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
