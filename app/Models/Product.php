<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'amount_per_minute',
        'started_at',
        'finished_at',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    public function inactiveRelations()
    {
        return $this->hasMany(InactiveRelation::class);
    }
}
