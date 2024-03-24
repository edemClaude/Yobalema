<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperPermisConduite
 */
class PermisConduite extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Cette méthode permet de retrouver la catégorie
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Cette fonction permet de retrouver toutes les catégories
     * @return array
     */
    public static function categories(): array
    {
        return Category::all()->pluck('id', 'type_permis')->toArray();
    }
}

