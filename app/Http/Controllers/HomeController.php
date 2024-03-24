<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function accueil(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Vehicule::categories();
        return view('home.index', compact('categories'));
    }
}
