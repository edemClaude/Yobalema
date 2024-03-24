<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::with('role')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.users.form', [
                'user' => new User(),
                'roles' => User::roles(),
            ]
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request): RedirectResponse
    {
        try {
            $request = (new User())->saveImage( $request);
            User::create($request);
            return redirect()->route('admin.users.index')
                ->with('success', 'Utilisateur créé avec succès');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.users.profile',[
            'user' => $user,
            'roles' => User::roles(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.users.profile', [
                'user' => $user,
                'roles' => User::roles(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, User $user): RedirectResponse
    {
        try {
            $request = $user->saveImage($request);
            $user->update($request);
            return redirect()->route('admin.users.show', $user)
                ->with('success', 'Utilisateur mis à jour avec succès');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->delete();
            return redirect()->route('admin.users.index')
                ->with('success', 'Utilisateur supprimé avec succès');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
