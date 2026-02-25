<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'owes_user_id',
        'receives_user_id',
        'amount',
        'is_paid',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_paid' => 'boolean',
        ];
    }

    public function owes(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owes_user_id');
    }

    public function receives(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receives_user_id');
    }
}
