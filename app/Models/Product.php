<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'date',
        'images'
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d\TH:i:s'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            });
            })->when($filters['category'] ?? null, function ($query, $category) {
                $query->where(function ($query) use ($category) {
                    $query->where('category_id', 'like', '%'.$category.'%');
                
            });
        });    
    }

}
