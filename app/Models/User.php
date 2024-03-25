<?php

namespace App\Models;

use App\Http\Requests\UserFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'image',
        'email',
        'password',
        'role_id',
        'status',
        'telephone',
        'adresse',
        'permis_conduite_id',
        'vehicule_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Cette méthode permet de retourner le role
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Cette méthode permet de retrouver tous les roles sous forme de tableau
     * @return array
     */
    public static function roles(): array
    {
        return Role::all()->pluck('id', 'name')->toArray();
    }

    /**
     * Cette méthode permet de retrouver le permis de conduite
     * @return BelongsTo
     */
    public function permisConduite(): HasOne
    {
        return $this->hasOne(PermisConduite::class);
    }

    /**
     * Cette méthode permet de retrouver le vehicule
     * @return BelongsTo
     */
    public function vehicule(): BelongsTo
    {
        return $this->belongsTo(Vehicule::class);
    }

    /**
     * Cette méthode permet de retourner le nom complet de l'utilisateur
     * @return string
     */
    public function getFullName(): string
    {
        return $this->prenom . ' ' . strtoupper($this->nom);
    }

    /**
     * Cette méthode permet de retourner le contrat
     * @return HasOne
     */
    public function contrat(): HasOne
    {
        return $this->hasOne(Contrat::class);
    }

    /**
     * Cette méthode permet de savoir si l'utilisateur est admin
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    }

    /**
     * Cette méthode permet de traiter l'image et
     * retourner les informations validées par la request
     * @param UserFormRequest $request
     * @return mixed
     */
    public function saveImage(UserFormRequest $request): mixed
    {
        $data = $request->validated();
        $image = $request->validated('image');
        if ($image !== null && !$image->getError()) {
            if ($this->image) {
                Storage::disk('public')->delete($this->image);
            }
            $data['image'] = $image->store('images', 'public');
        }
        return $data;
    }

    /**
     * Cette méthode permet de retourner le chemin de l'image
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : Storage::disk('public')->url('defaut-profil.png');
    }

    /**
     * Cette méthode permet de mettre à jour le statut de l'utilisateur en
     * fonction de la date d'expiration du permis
     * @return bool
     */
    public function checkExpiration(): bool
    {
        if ($this->permisConduite->expiration < date('Y-m-d')
            && $this->permisConduite->is_valid) {
            $this->permisConduite->update(['is_valid' => false]);
            $this->update(['status' => 0]);
            return false;
        }
        return true;
    }

    /**
     * Cette fonction permet de mettre à jour le statut de l'utilisateur
     * en fonction de la date d'expiration du contrat
     * @return bool
     */
    public function checkContratValidation(): bool
    {
        // calcule de la date de fin du contrat
        $fin = Carbon::parse($this->contrat->date_embauche)
            -> addYears($this->contrat->duree);

        if($this->contrat->actived && $fin < date('Y-m-d')){
            $this->contrat->update(['actived' => false]);
            $this->update(['status' => 0]);
            return false;
        }
        return true;
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class, 'client_id', 'id');
    }

}
