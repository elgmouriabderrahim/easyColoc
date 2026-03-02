<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'colocation_id'
    ];

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
