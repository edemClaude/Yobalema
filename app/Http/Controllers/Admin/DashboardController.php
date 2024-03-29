<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contrat;
use App\Models\Location;
use App\Models\Payement;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->checkChauffeurs();
        $counts = $this->getCounts();
        $topChauffeurs = $this->getChauffeurs();
        $topClients = $this->getTopClients();
        $topVehicules = $this->getTopVehicules();
        $topPayements = $this->getTopPayements();
        $lastestLocations = $this->getLastestLocations();
        $montantTotalPayements = $this->getMontantTotalPayements();
        return view('admin.dashboard',
            compact('counts', 'topChauffeurs',
                'topClients', 'topVehicules', 'topPayements',
                'lastestLocations', 'montantTotalPayements')
        );
    }

    public function checkChauffeurs(): void
    {
        $chauffeurs = User::where('role_id', 3)->get();
        foreach ($chauffeurs as $chauffeur) {
            if ($chauffeur->status == 1 && (!$chauffeur->checkContratValidation() || !$chauffeur->checkExpiration())) {
                $chauffeur->vehicule()->update(['user_id' => null]);
                $chauffeur->update(['vehicule_id' => null]);
            }
        }
    }

    /**
     * Cette fonction permet de faire le comptage des différentes entités
     * @return array
     */
    public function getCounts(): array
    {
        return [
            'chauffeurs' => User::where('role_id', 3)->count(),
            'clients' => User::where('role_id', 2)->count(),
            'admins' => User::where('role_id', 1)->count(),
            'users' => User::count(),
            'contrats' => Contrat::count(),
            'vehicules' => Vehicule::count(),
            'locations' => Location::count(),
        ];
    }

    /**
     * Cette fonction permet de faire le top 5 des chauffeurs
     * @return Collection|array
     */
    public function getChauffeurs(): Collection|array
    {
        return User::with('contrat', 'vehicule', 'notes')
            ->whereNotNull('vehicule_id')
            ->take(10)->get();
    }

    /**
     * Cette fonction permet de faire le top 5 des clients
     * @return array
     */
    public function getTopClients(): array
    {
        return User::where('role_id', 2)
            ->take(5)->get()->toArray();
    }

    /**
     * Cette fonction permet de faire le top 5 des vehicules
     * @return array
     */
    public function getTopVehicules(): array
    {
        return Vehicule::take(5)->get()->toArray();
    }

    /**
     * Cette fonction permet de faire le top 10 des payements
     * @return array
     */
    public function getTopPayements(): array
    {
        return Payement::take(10)->get()->toArray();
    }

    // montant total des payements du mois en cour

    /**
     * Cette fonction permet de faire le montant total des payements du mois en cour
     * @return float
     */
    public function getMontantTotalPayements(): float
    {
        return Payement::whereMonth('created_at', date('m'))->sum('montant');
    }

    /**
     * @return Payement[]|Builder[]|Collection
     */
    public function getLastestLocations(): Collection|array
    {
        return Location::with('chauffeur', 'client')
            ->orderBy('created_at', 'desc')
            ->take(10)->get();
    }

}
