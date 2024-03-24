<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.categories.index', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.categories.form', [
            'category' => new Category(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryFormRequest $request): RedirectResponse
    {
        try {
            Category::create($request->validated());
            return redirect()->route('admin.categories.index')
                ->with('success', 'Catégorie crée avec succès');
        } catch (Exception $exception) {
            return redirect()->back()
                -> with('error', $exception->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryFormRequest $request, Category $category): RedirectResponse
    {
        try {
            $category->update($request->validated());
            return redirect()->route('admin.categories.index')
                ->with('success', 'Catégorie modifié avec succès');
        } catch (Exception $exception) {
            return redirect()-> back()
                -> with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            $category->delete();
            return redirect()->route('admin.categories.index')
                -> with('success', 'Catégorie supprimé avec succès');
        } catch (Exception $exception) {
            return redirect()->back()
                -> with('error', $exception->getMessage());
        }

    }
}
