<?php

namespace App\Models;

use App\Http\Requests\VehiculeFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperVehicule
 */
class Vehicule extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Cette relation permet de récupérer le conducteur du véhicule
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Cette relation permet de récupérer la catégorie du véhicule
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Cette méthode permet de récupérer toutes les catégories sous forme d'un tableau
     * @return array
     */
    public static function categories(): array
    {
        return Category::all() ->pluck('id', 'name') ->toArray();
    }

    /**
     * Cette relation permet de récupérer les locations du véhicule
     * @return HasMany
     */
    public function locations() : HasMany
    {
        return $this->hasMany(Location::class);
    }

    /**
     * This method is used to save and update image in storage and return data to be saves
     * @param VehiculeFormRequest $request
     * @return mixed
     */
    public function saveImage(VehiculeFormRequest $request): mixed
    {
        $data = $request->validated();
        $image = $request->validated('image');
        if ($image != null && !$image->getError()) {
            if ($this->image) {
                Storage::disk('public')->delete($this->image);
            }
            $data['image'] = $image->store('vehicles', 'public');
        }
        return $data;
    }

    /**
     * Cette méthode permet de retourner le chemin de l'image
     * @return string
     */
    public function getImage(): string
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : Storage::disk('public')->url('defaut-car.png');
    }
}
