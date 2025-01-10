<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount',
        'date',
        'category_id',
    ];

    // Cast dates for Laravel formats

    protected $casts = [
        'date' => 'date'
    ];

    // Category relation
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Validaciones
    public static $rules = [
        'description' => 'required|max:255',
        'amount' => 'required|numeric|min:0.01',
        'date' => 'required|date',
        'category_id' => 'required|exists:categories,id',
    ];
}