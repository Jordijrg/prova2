<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afegir1;
use Inertia\Inertia;

class Afegir1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Afegir1::all(); // Obtener todos los datos de la tabla afegir1
    return Inertia::render("Afegir1", ['datos' => $datos]); // Pasar los datos a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
    $request->validate([
        'nom' => 'required|string|max:255',
    ]);

    // Crear una nueva instancia del modelo Afegir1 y asignarle los datos
    $afegir = new Afegir1();
    $afegir->nom = $request->nom;
    
    // Guardar los datos en la base de datos
    $afegir->save();

    // Redirigir a la página deseada después de guardar los datos
    return redirect()->route('afegir1.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
