<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermisFormRequest;
use App\Models\PermisConduite;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PermisController extends Controller
{

    public function create(User $chauffeur): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.chauffeurs.permis.form', [
            'chauffeur' => $chauffeur,
            'categories' => PermisConduite::categories(),
        ]);
    }

    /**
     * Cette methode permet d'enregistrer un permis
     * @param PermisFormRequest $request
     * @return RedirectResponse
     */
    public function store(PermisFormRequest $request): RedirectResponse
    {
        try{
            $validated = $request->validated();
            // Verifier si la date d'expiration du permis est supérieur à la date du jour
            if ($validated['expiration'] < date('Y-m-d')) {
                return redirect()->back()->with('error',
                    'Votre permis est expiré. Veuillez le renouveler.');
            } else {
                $validated['is_valid'] = true;
            }

            PermisConduite::create($validated);
            $chauffeur = User::findOrFail($validated['user_id']);
            return redirect()->back()
                ->with('success', "Permis de {$chauffeur->getFullName()} enregistré avec succès.");

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
        return view('admin.chauffeurs.permis.form', [
            'chauffeur' => $chauffeur,
            'categories' => PermisConduite::categories(),
        ]);
    }

    /**
     * @param PermisFormRequest $request
     * @param PermisConduite $permis
     * @return RedirectResponse
     */
    public function update(PermisFormRequest $request, PermisConduite $permis): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $permis->update($validated);
            $chauffeur = User::findOrFail($validated['user_id']);
            return to_route('admin.users.show', $chauffeur)
                ->with('success', 'Permis mis à jour avec succès');
        }catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * This method deletes a permis
     * @param PermisConduite $permis
     * @return RedirectResponse
     */
    public function destroy(PermisConduite $permis): RedirectResponse
    {
        try {
            $permis->delete();
            return redirect()->back()->with('success', 'Permis supprimé avec succès');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
