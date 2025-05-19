<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InactiveRelation extends Model
{
    protected $fillable = ['product_id', 'missing_dependency_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function missingDependency()
    {
        return $this->belongsTo(Product::class, 'missing_dependency_id');
    }
}

