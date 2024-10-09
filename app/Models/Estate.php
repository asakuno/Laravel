<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

class Estate extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_for_sale' => 'boolean',
    ];

    /**
     * user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * estate_profile
     *
     * @return HasOne
     */
    public function estate_profile(): HasOne
    {
        return $this->hasOne(EstateProfile::class, 'estate_id');
    }
}
