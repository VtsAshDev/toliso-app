<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wallet extends Model
{
  protected $fillable = [
      'balance',
    ];

  protected static function booted()
  {
      static::created(function ($wallet) {
          $wallet->savingRelation()->create([
                  'balance' => 0,
              ]);
      });
  }

  public function user() : BelongsTo
  {
      return $this->belongsTo(User::class);
  }

  public function savingRelation() : HasOne
  {
      return $this->hasOne(Saving::class);
  }

  public function transactions() : HasMany
  {
      return $this->hasMany(Transaction::class);
  }

}
