<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductDependency extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'depends_on_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function dependency() {
        return $this->belongsTo(Product::class, 'depends_on_id');
    }
}
