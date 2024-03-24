<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperContrat
 */
class Contrat extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPE = array('CDI' => 'CDI', 'CDD' => 'CDD');

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
