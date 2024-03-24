<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationFormRequest;
use App\Models\Location;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use NominatimLaravel\Content\Nominatim;
use NominatimLaravel\Exceptions\NominatimException;

class LocationController extends Controller
{
    /**
     * @throws GuzzleException
     * @throws NominatimException
     */
    public function geocode(String $location)
    {
        $url = "https://nominatim.openstreetmap.org";
        $nominatim = new Nominatim($url);

        $search = $nominatim->newSearch();
        $search->query("dakar");

        $result = $nominatim->find($search);

        return $result[0]->getLat() . ", " . $result[0]->getLng();

    }

    public function location(LocationFormRequest $request)
    {
        $error = false;
        try{



        } catch (GuzzleException $e) {
            $error = $e->getMessage();
        } catch (NominatimException $e) {
            $error = $e->getMessage();
        }

        if($error){
            return redirect()->back()->with('error', $error);
        } else {
            return redirect()->back()->with('success', 'success');
        }
    }
}
