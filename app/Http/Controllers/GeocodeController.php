<?php

namespace App\Http\Controllers;

use NominatimLaravel\Content\Nominatim;
use NominatimLaravel\Exceptions\NominatimException;

class GeocodeController extends Controller
{
    /**
     * @throws NominatimException
     */
    public function geocode()
    {
        $url = "https://nominatim.openstreetmap.org";
        $nominatim = new Nominatim($url);

        $search = $nominatim->newSearch();
        $search->query("dakar");

        $result = $nominatim->find($search);

        return array('lat' => $result[0]['lat'], 'lon' => $result[0]['lon']);

    }

}
