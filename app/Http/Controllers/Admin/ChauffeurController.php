<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\PermisConduite;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ChauffeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $chauffeurs = User::with('role', 'permisConduite.category', 'contrat', 'vehicule')
            ->where('role_id', 3) -> get();
        $categories = PermisConduite::categories();

        return view('admin.chauffeurs.index', compact('chauffeurs', 'categories'));
    }

    /**
     * Cette fonction permet de changer le statut du chauffeur
     * @param User $chauffeur
     * @return RedirectResponse
     */
    public function changeStatus(User $chauffeur): RedirectResponse
    {
        try {
            $chauffeur->update([
                'active' => !$chauffeur->status
            ]);
            return redirect()->back()
                ->with('success',
                    $chauffeur->getFullName() . " est désormais " . ($chauffeur->status ? 'actif' : 'inactif')
                );
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.chauffeurs.form', [
            'chauffeur' => new User(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request): RedirectResponse
    {
        try {

            $validated = (new User())->saveImage($request);
            $validated['role_id'] = 3;
            $validated['status'] = false;
            $chauffeur = User::create($validated);

            return redirect()->route('admin.chauffeurs.show', $chauffeur);
        } catch (Exception $ex) {
            return redirect()
                ->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $chauffeur): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $chauffeur->load('role', 'permisConduite.category', 'contrat', 'vehicule');
        return view('admin.users.profile', [
            'user' => $chauffeur,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $chauffeur): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.chauffeurs.form', [
            'chauffeur' => $chauffeur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, User $chauffeur): RedirectResponse
    {
        try {

            $validated = $chauffeur->saveImage($request);
            $chauffeur->update($validated);
            return redirect()->route('admin.chauffeurs.show', $chauffeur)
                ->with('success', 'Chauffeur mis à jour avec succès');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $chauffeur): RedirectResponse
    {
        try {
            if ($chauffeur->image) {
                Storage::disk('public')->delete($chauffeur->image);
            }
            $chauffeur->delete();
            return redirect()->route('admin.chauffeurs.index')
                ->with('success', 'Chauffeur supprimé avec succès');
        } catch (Exception $ex) {
            return redirect()->back()
                ->with('error', $ex->getMessage());
        }
    }
}
