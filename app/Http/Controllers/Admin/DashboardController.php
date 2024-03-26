<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contrat;
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
        $counts = $this->getCounts();
        $topChauffeurs = $this->getTopChauffeurs();
        $topClients = $this->getTopClients();
        $topVehicules = $this->getTopVehicules();
        $topPayements = $this->getTopPayements();
        $todayTransactions = $this->getTodayTransactions();
        $montantTotalPayements = $this->getMontantTotalPayements();
        return view('admin.dashboard',
            compact('counts', 'topChauffeurs',
                'topClients', 'topVehicules', 'topPayements',
                'todayTransactions', 'montantTotalPayements')
        );
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
            'users' => User::count(),
            'contrats' => Contrat::count(),
            'vehicules' => Vehicule::count(),
        ];
    }

    /**
     * Cette fonction permet de faire le top 5 des chauffeurs
     * @return array
     */
    public function getTopChauffeurs(): array
    {
        return User::where('role_id', 3)
            ->take(5)->get()->toArray();
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
    public function getTodayTransactions(): Collection|array
    {
        return Payement::whereDate('created_at', date('Y-m-d'))->get();
    }

}
