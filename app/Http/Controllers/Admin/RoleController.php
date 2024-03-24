<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\RoleFormRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.roles.index', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.roles.form', [
            'role' => new Role(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleFormRequest $request): RedirectResponse
    {
        try {

            Role::create($request->validated());
            return redirect()->route('admin.roles.index')
                ->with('success', 'Role created successfully');
        } catch (Exception $exception) {
            return redirect() -> back()
                -> with('error', $exception->getMessage());
        }


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        return view('admin.roles.form',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleFormRequest $request, Role $role): RedirectResponse
    {
        try {
            $role->update($request->validated());
            return redirect()->route('admin.roles.index')
                ->with('success', 'Role modifié avec succès');
        } catch (Exception $exception) {
            return redirect()-> back()
                -> with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        try {
            $role->delete();
            return redirect()->route('admin.roles.index')
                ->with('success', 'Role supprimé avec succès');
        } catch (Exception $exception) {
            return redirect() -> back()
                -> with('error', $exception->getMessage());
        }
    }
}
