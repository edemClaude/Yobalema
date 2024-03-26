<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationFormRequest;
use App\Models\Location;
use App\Models\User;
use App\Models\Vehicule;
use Auth;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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
//            return response()->json(
//                ['error' => 'Aucun véhicule disponible pour cette catégorie de véhicule ']
//            );
            return redirect() -> back()
                ->with('error', 'Aucun véhicule disponible pour cette catégorie de véhicule ');

        }
        $validated['vehicule_id'] = $vehicule->id;
        $validated['chauffeur_id'] = $vehicule->user_id;
/*
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
        );*/
        Location::create($validated);
        $vehicule?->update(['status' => 'EN LOCATION']);
        return redirect() -> route('location.client.last', Auth::user())
            ->with('success', 'Location effectuee avec succes');

        // return response()->json(['success' => $datas]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            Location::create($request->all());
            $vehicule = Vehicule::find($request->input('vehicule_id'));
            $vehicule?->update(['status' => 'EN LOCATION']);
        }catch (Exception $ex) {
            // return response()->json(['error' => $ex->getMessage()]);
            return redirect() -> back()->with('error', $ex->getMessage());
        }

        //return response()->json(['success' => 'Location effectuee avec succes']);
        return redirect() -> route('location.client.last')->with('success', 'Location effectuee avec succes');
    }

    /**
     * @param Location $location
     * @return RedirectResponse
     */
    public function destroy(Location $location): RedirectResponse
    {
        try {
            $vehicule = Vehicule::find($location->vehicule_id);
            $vehicule->update(['status' => 'DISPONIBLE']);
            $location->delete();
            return redirect() -> back()->with('success', 'Location supprimée avec succes');
        } catch (Exception $ex) {
            return redirect() -> back()->with('error', $ex->getMessage());
        }
    }

    /**
     * @param User $client
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|RedirectResponse
     */
    public function clientLocationsAll(User $client)
    {
        try {
            $locations = $client->locations;
            return view('home.clients.all-locations',
                compact('locations')
            );
        } catch (Exception $ex) {
            return redirect() -> back()->with('error', $ex->getMessage());
        }
    }

    /**
     * @param User $client
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|RedirectResponse
     */
    public function clientLocationLast(User $client)
    {
        try {
            $location = $client->locations()->orderBy('id', 'desc')->first();
            return view('home.clients.one-location', compact('location'));
        } catch (Exception $ex) {
            return redirect() -> back()->with('error', $ex->getMessage());
        }
    }

    public function chauffeurLocationsAll(User $chauffeur)
    {
        try {
            $locations = Location::where('chauffeur_id', $chauffeur->id)->get();
            return view('home.chauffeurs.all-locations',
                compact('locations')
            );
        } catch (Exception $ex) {
            return redirect() -> back()->with('error', $ex->getMessage());
        }
    }

    public function chauffeurLocationLast(User $chauffeur)
    {
        try {
            $location = Location::where('chauffeur_id', $chauffeur->id)
                ->orderBy('id', 'desc')->first();
            return view('home.chauffeurs.current-location', compact('location'));
        } catch (Exception $ex) {
            return redirect() -> back()->with('error', $ex->getMessage());
        }
    }



}
