<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Cette méthode permet de retourner les vehicules liées à cette catégorie
     * @return HasMany
     */
    public function vehicules(): HasMany
    {
        return $this->hasMany(Vehicule::class);
    }

    /**
     * Cette méthode permet de retourner les permis liés à cette catégorie
     * @return HasMany
     */
    public function permis(): HasMany
    {
        return $this->hasMany(PermisConduite::class);
    }
}
