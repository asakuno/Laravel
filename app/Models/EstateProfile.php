<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

class EstateProfile extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = 'estate_profile';

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];

    /**
     * post
     *
     * @return BelongsTo
     */
    public function estate(): BelongsTo
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }
}
