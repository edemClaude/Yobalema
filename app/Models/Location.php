<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperLocation
 */
class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'heure_depart',
        'heure_arrivee',
        'lieu_depart',
        'lieu_arrivee',
        'date_location',
        'chauffeur_id',
        'client_id',
        'prix_estime',
    ];

    /**
     * @return BelongsTo
     */
    public function chauffeur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'chauffeur_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

}
