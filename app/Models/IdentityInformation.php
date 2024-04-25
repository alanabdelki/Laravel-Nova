<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdentityInformation extends Model
{

    protected $fillable=['military_services','reason_of_exempt,nationality'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
