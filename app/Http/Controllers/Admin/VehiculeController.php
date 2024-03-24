<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\VehiculeFormRequest;
use App\Models\User;
use App\Models\Vehicule;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.vehicules.index', [
            'vehicules' => Vehicule::with('category')->get(),
        ]);
    }

    /**
     * Cette méthode permet d'attribuer un véhicule à un chauffeur
     * @param User $chauffeur
     * @return RedirectResponse
     */
    public function assign(User $chauffeur): RedirectResponse
    {
        try {
            // Verifier si le chauffeur a un permis de conduire et un contrat
            if ($chauffeur->permisConduite->is_valid && $chauffeur->contrat->actived) {
                // récupérer le véhicule disponible
                $vehicule = Vehicule::where('category_id', $chauffeur->permisConduite->category_id)
                    ->whereNull('user_id')->first();
                if (!$vehicule) {
                    throw new Exception('Aucun véhicule disponible');
                }
                // attribuer le véhicule au chauffeur
                $chauffeur->update(['vehicule_id' => $vehicule->id]);
                $vehicule->update(['user_id' => $chauffeur->id]);

                // activer le chauffeur
                $chauffeur->update(['status' => 1]);
                return redirect()->back()
                    -> with('success', 'Véhicule attribue avec succès');

            } else {
                throw new Exception(
                    'Le chauffeur n\'a pas de permis de conduire ou le contrat n\'est pas actif');

            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Cette méthode permet de retirer le véhicule d'un chauffeur
     * @param User $chauffeur
     * @return RedirectResponse
     */
    public function unassign(User $chauffeur): RedirectResponse
    {
        try {
            // Retirer le véhicule du chauffeur
            $chauffeur->vehicule->update(['user_id' => null]);
            $chauffeur->update(['vehicule_id' => null]);
            $chauffeur->update(['status' => 0]);
            return redirect()->back()
                -> with('success', 'Véhicule retire avec succès');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.vehicules.form', [
            'vehicule' => new Vehicule(),
            'categories' => Vehicule::categories(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param VehiculeFormRequest $request
     * @return RedirectResponse
     */
    public function store(VehiculeFormRequest $request): RedirectResponse
    {
        try {
            $request = (new Vehicule())->saveImage($request);
            $request['km_actuel'] = $request['km_defaut'];
            Vehicule::create($request);
            return redirect()->route('admin.vehicules.index')
                ->  with('success', 'Véhicule créé avec succès');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param Vehicule $vehicule
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show(Vehicule $vehicule): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.vehicules.show', [
            'vehicule' => $vehicule
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Vehicule $vehicule
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(Vehicule $vehicule): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.vehicules.form', [
            'vehicule' => $vehicule,
            'categories' => Vehicule::categories(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param VehiculeFormRequest $request
     * @param Vehicule $vehicule
     * @return RedirectResponse
     */
    public function update(VehiculeFormRequest $request, Vehicule $vehicule): RedirectResponse
    {
        try {
            $request = $vehicule->saveImage($request);
            $request['km_actuel'] = $request['km_defaut'];
            $vehicule->update($request);
            return redirect()->route('admin.vehicules.index')
                ->  with('success', 'Véhicule mis à jour avec succès');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Vehicule $vehicule
     * @return RedirectResponse
     */
    public function destroy(Vehicule $vehicule): RedirectResponse
    {
        try {
            if ($vehicule->image) {
                Storage::disk('public')->delete($vehicule->image);
            }
            $vehicule->delete();
            return redirect()->route('admin.vehicules.index')
                ->  with('success', 'Véhicule supprimé avec succès');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
