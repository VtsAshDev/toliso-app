<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $fillable = ['name','type',];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
