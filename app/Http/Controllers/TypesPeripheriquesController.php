<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypePeripherique;

class TypesPeripheriquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = TypePeripherique::all();
        return view('types-peripheriques.index', compact('types'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('types-peripheriques.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'libelle_type' => 'required|string|max:255',
        ]);
        TypePeripherique::create($validatedData);
        return redirect()->route('types-peripheriques.index')->with('success', ' Type de Périphérique ajouté avec succès');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $types = TypePeripherique::findOrFail($id);
        return view('types-peripheriques.show',compact('types'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $types = TypePeripherique::findOrFail($id);
        return view('types-peripheriques.edit',compact('types'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypePeripherique $types)
    {
        $validated = $request->validate([
            'libelle_type' => 'required|unique:types-peripheriques,libelle_type,' . $types->id,

        ]);

        $types->update($validated);
        return redirect()->route('types-peripheriques.index')->with('success', 'Type de périphérique mis à jour avec succès');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $types = TypePeripherique::findOrFail($id);
        $types->delete();
        return redirect()->route('types-peripheriques.index')->with('success', ' Type de Périphérique supprimé avec succès');
    }
}
