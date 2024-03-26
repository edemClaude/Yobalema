<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayementFormRequest;
use App\Models\Location;
use App\Models\Payement;
use App\Models\Vehicule;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PayementFormRequest $request): RedirectResponse
    {
        try {
            $payer = $request->validated();

            $location = Location::find($payer['location_id']);

            $payer['montant'] = $location->prix_estime;
            $payer['date'] = now();
            $distance = $location->distance();

            $depart = Carbon::parse($location->heure_depart);

            $arrivee = $depart->addHours($distance / 60);

            $location->update(['heure_arrivee' => $arrivee]);
            $payer['regler'] = 1;
            Payement::create($payer);

            $vehicule = Vehicule::find($location->vehicule_id);
            $vehicule->update(['km_actuel' => $vehicule->km_actuel + $distance,
                'status' => "DISPONIBLE"]);

            return to_route('location.client.last', Auth::user())
                ->with('success', 'Payement effectué avec succès');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        } catch (GuzzleException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
