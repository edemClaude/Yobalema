<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationFormRequest;
use App\Models\Location;
use App\Models\Vehicule;
use Auth;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use NominatimLaravel\Exceptions\NominatimException;

class LocationController extends Controller
{

    /**
     * @param LocationFormRequest $request
     * @return JsonResponse|RedirectResponse
     * @throws GuzzleException
     * @throws NominatimException
     */
    public function location(LocationFormRequest $request): JsonResponse|RedirectResponse
    {

        $validated = $request->validated();
        $dist = (new Location())-> distance($validated['lieu_depart'], $validated['lieu_destination']);
        // estimer le prix du trajet en fonction de la distance
        $validated['prix_estime'] = $dist * Location::PRIX_KM;
        $validated['client_id'] = Auth::user()->id; // ajouter l'id du client

        $validated['heure_depart'] = date('Y-m-d H:i',
            strtotime($validated['date_location'] . " " . $validated['heure_depart'])
        );

        // Récupérer le véhicule disponible dans la catégorie recherchée
        $vehicule = Vehicule::where('category_id', $validated['type_vehicule'])
            -> whereNotNull('user_id')
            -> where('status', 'DISPONIBLE')->first();
        if ($vehicule == null) {
            return response()->json(
                ['error' => 'Aucun véhicule disponible pour cette catégorie de véhicule ']
            );
        }

        $datas = array(
            'vehicule_type' => $vehicule->category->name,
            'vehicule_image' => $vehicule->getImage(),
            'chauffeur_name' => $vehicule->user->getFullName(),
            'chauffeur_image' => $vehicule->user->getAvatar(),
            'lieu_depart' => $validated['lieu_depart'],
            'lieu_destination' => $validated['lieu_destination'],
            'distance' => round($dist) . ' km',
            'prix_estime' => round($validated['prix_estime']) . ' FCFA',
            'date_location' => $validated['date_location'],
            'heure_depart' => $validated['heure_depart'],
            'location' => $validated
        );
        // Location::create($validated);
        // $vehicule->update(['status' => 'EN LOCATION']);

        return response()->json(['success' => $datas]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $jsonData = json_decode(key($request->all()), true);

        dd($jsonData);
        //$location->save();

        //return response()->json($location);
    }
}
