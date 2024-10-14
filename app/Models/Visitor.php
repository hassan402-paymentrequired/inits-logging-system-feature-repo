<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visitor extends Model
{
    use HasFactory;

    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function visitorhistories():HasMany{
        return $this->hasMany(VisitorHistories::class);
    }
}
