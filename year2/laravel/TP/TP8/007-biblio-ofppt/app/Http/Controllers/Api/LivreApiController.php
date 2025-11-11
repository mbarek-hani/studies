<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use Illuminate\Http\Request;

class LivreApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Livre::all();
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
            'isbn' => 'required|unique:livres,isbn'
        ]);
        $livre = Livre::create($request->all());
        return response()->json($livre, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Livre $livre)
    {
        return $livre;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livre $livre)
    {
        $request->validate([
            'title' => 'sometimes|required|max:255',
            'auteur' => 'sometimes|required',
            'annee' => 'sometimes|required|integer',
            'isbn' => 'sometimes|required|unique:livres,isbn,' . $livre->id,
        ]);
        $livre->update($request->all());
        return response()->json($livre, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livre $livre)
    {
        $livre->delete();
        return response()->json(['message' => 'Livre supprimé avec succès'], 200);
    }
}
