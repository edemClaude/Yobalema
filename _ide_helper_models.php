<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $type_permis
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PermisConduite> $permis
 * @property-read int|null $permis_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vehicule> $vehicules
 * @property-read int|null $vehicules_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTypePermis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCategory {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property int $user_id
 * @property int $salaire
 * @property int|null $duree
 * @property string $type
 * @property int $actived
 * @property string $date_embauche
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereActived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereDateEmbauche($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereDuree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereSalaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrat whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperContrat {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $heure_depart
 * @property string|null $heure_arrivee
 * @property string $date_location
 * @property string $lieu_depart
 * @property string $lieu_destination
 * @property int $prix_estime
 * @property int|null $chauffeur_id
 * @property int|null $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $vehicule_id
 * @property-read \App\Models\User|null $chauffeur
 * @property-read \App\Models\User|null $client
 * @property-read \App\Models\Vehicule|null $vehicule
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereChauffeurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDateLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereHeureArrivee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereHeureDepart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLieuDepart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLieuDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location wherePrixEstime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereVehiculeId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLocation {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $value
 * @property int $user_id
 * @property int $location_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereValue($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperNote {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $mode
 * @property int $location_id
 * @property int $montant
 * @property int $regler
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereRegler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPayement {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $num_permis
 * @property int $category_id
 * @property string $delivrance
 * @property string $expiration
 * @property int $annee_experience
 * @property int $is_valid
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite query()
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereAnneeExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereDelivrance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereNumPermis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermisConduite whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPermisConduite {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nom
 * @property string|null $prenom
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $image
 * @property string $password
 * @property string|null $telephone
 * @property string|null $adresse
 * @property int $status
 * @property int $role_id
 * @property int|null $permis_conduite_id
 * @property int|null $vehicule_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contrat|null $contrat
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Location> $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PermisConduite|null $permisConduite
 * @property-read \App\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\Vehicule|null $vehicule
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePermisConduiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVehiculeId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $matricule
 * @property string|null $image
 * @property string $date_achat
 * @property int $km_defaut
 * @property int $km_actuel
 * @property string $status
 * @property int $category_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Location> $locations
 * @property-read int|null $locations_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\VehiculeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereDateAchat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereKmActuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereKmDefaut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereMatricule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicule whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperVehicule {}
}

