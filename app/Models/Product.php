<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'started_at' => 'datetime',
        'finished_at'=> 'datetime',
        'active'     => 'boolean',
    ];

    // Een product “maakt” (eigenaar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Zelf‑relatie: van en naar dependencies
    public function dependencies()
    {
        return $this->belongsToMany(
            Product::class,
            'product_dependencies',
            'product_id',
            'depends_on_id'
        )->withTimestamps();
    }

    public function dependents()
    {
        return $this->belongsToMany(
            Product::class,
            'product_dependencies',
            'depends_on_id',
            'product_id'
        )->withTimestamps();
    }

    // Inactive relations
    public function inactiveRelations()
    {
        return $this->hasMany(InactiveRelation::class);
    }
}

