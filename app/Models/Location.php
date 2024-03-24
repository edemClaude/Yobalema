<?php

namespace App\Models;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use NominatimLaravel\Content\Nominatim;
use NominatimLaravel\Exceptions\NominatimException;

/**
 * @mixin IdeHelperLocation
 */
class Location extends Model
{
    use HasFactory;

    const PRIX_KM = 300;

    protected $fillable = [
        'heure_depart',
        'heure_arrivee',
        'lieu_depart',
        'lieu_destination',
        'date_location',
        'chauffeur_id',
        'client_id',
        'prix_estime',
        'vehicule_id',
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


    /**
     * @throws GuzzleException
     * @throws NominatimException
     */
    public function geocode(String $location): array
    {
        $url = "https://nominatim.openstreetmap.org";
        $nominatim = new Nominatim($url);

        $search = $nominatim->newSearch();
        $search->query($location);

        $result = $nominatim->find($search);

        return array('lat' => $result[0]['lat'], 'lon' => $result[0]['lon']);

    }

    /**
     * Cette methode utilise la formule Haversine pour calculer la distance entre deux points
     * @param $lat1
     * @param $lon1
     * @param $lat2
     * @param $lon2
     * @return float|int
     */
    private function distanceHaversine($lat1, $lon1, $lat2, $lon2): float|int
    {
        $earthRadius = 6371; // rayon de la terre en kilomètres

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        // distance en kilomètres

        return $earthRadius * $c;
    }

    /**
     * @throws GuzzleException
     * @throws NominatimException
     */
    public function distance($city1 = null, $city2 = null): float|int
    {
        if ($city1 == null) {$city1 = $this->lieu_depart;}
        if ($city2 == null) {$city2 = $this->lieu_destination;}

        $coords1 = $this->geocode($city1);
        $coords2 = $this->geocode($city2);

        return $this->distanceHaversine(
            $coords1['lat'], $coords1['lon'], $coords2['lat'], $coords2['lon']);
    }
}
