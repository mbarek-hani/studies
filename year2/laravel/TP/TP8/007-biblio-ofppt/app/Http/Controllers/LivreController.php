<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livres = Livre::all();
        return view('livres.index', compact('livres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'auteur' => 'required',
            'annee' => 'required|integer',
            'isbn' => 'required|unique:livres,isbn',
            'editeur' => 'required'
        ]);
        Livre::create($request->all());
        return redirect()->route('livres.show')
            ->with('success', 'Livre ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livre $livre)
    {
        return view('livres.edit', compact('livre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livre $livre)
    {
        $request->validate([
            'title' => 'required',
            'auteur' => 'required',
            'annee' => 'required|integer',
            'isbn' => 'required|unique:livres,isbn,' . $livre->id,
            'editeur' => 'required',
        ]);
        $livre->update($request->all());
        return redirect()->route('livres.index')
            ->with('success', 'Livre modifié acvec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livre $livre)
    {
        $livre->delete();
        return redirect()->route('livres.index')
            ->with('success', 'Livre supprimé avec succès');
    }
}
