<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'wallet_id',
        'category_id',
        'is_recurring',
        'description',
        'amount',
        'installments',
        'due_date',
        'transaction_date',
    ];


    public function wallet() : BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
