<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContratFormRequest;
use App\Models\Contrat;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    /**
     * @param User $chauffeur
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function create(User $chauffeur): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.chauffeurs.permis.form', [
            'chauffeur' => $chauffeur,
        ]);
    }

    /**
     * Cette methode permet d'enregistrer un contrat
     * @param ContratFormRequest $request
     * @return RedirectResponse
     */
    public function store(ContratFormRequest $request): RedirectResponse
    {
        try{
            $validated = $request->validated();
            // Ajouter la durée du contrat a la date d'ajout pour obtenir la date de fin
            $chauffeur = User::findOrFail($validated['user_id']);
            $validated['code'] = date('Ymd-His') . $chauffeur->id;
            Contrat::create($validated);
            return redirect()->back()
                ->with('success', "Contrat de {$chauffeur->getFullName()} enregistré avec succès.");

        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Cette methode permet de retourner la page d'édition d'un permis
     * @param User $chauffeur
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(User $chauffeur): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.chauffeurs.contrats.form', [
            'chauffeur' => $chauffeur,
        ]);
    }

    /**
     * @param ContratFormRequest $request
     * @param Contrat $contrat
     * @return RedirectResponse
     */
    public function update(ContratFormRequest $request, Contrat $contrat): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $contrat->update($validated);
            $chauffeur = User::findOrFail($validated['user_id']);
            return to_route('admin.users.show', $chauffeur)
                ->with('success', 'Contrat mis à jour avec succès');
        }catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * This method deletes a permis
     * @param Contrat $contrat
     * @return RedirectResponse
     */
    public function destroy(Contrat $contrat): RedirectResponse
    {
        try {
            $contrat->delete();
            return redirect()->back()->with('success', 'Contrat supprimé avec succès');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
