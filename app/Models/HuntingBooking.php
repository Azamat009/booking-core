<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HuntingBooking extends Model
{
    protected $fillable = [
        'tour_name',
        'hunter_name',
        'guide_id',
        'from_date',
        'to_date',
        'participant_count'
    ];

    public function guide(): BelongsTo{
        return $this->belongsTo(Guide::class);
    }
}
