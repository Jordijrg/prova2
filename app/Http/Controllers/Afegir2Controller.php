<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afegir2;
use Inertia\Inertia;

class Afegir2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        'titol' => 'required|string|max:255',
        'contingut' => 'required|string|max:255',
        'id_curs' => 'required|string|max:150',
    ]);

    // Crear una nueva instancia del modelo Afegir1 y asignarle los datos
    $afegir = new Afegir2();
    $afegir->titol = $request->titol;
    $afegir->contingut = $request->contingut;
    $afegir->id_curs = $request->id_curs;
    
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
                // Obtén el recurso a actualizar
                $afegir2 = Afegir2::findOrFail($id);
    
                // Actualiza los datos del recurso con los proporcionados en la solicitud
                $afegir2->update($request->all());
            
                // Redirige a la página deseada después de actualizar el recurso
                return redirect()->route('afegir1.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
                // Buscar el elemento a eliminar por su ID
                $afegir = Afegir2::findOrFail($id);

                // Eliminar el elemento de la base de datos
                $afegir->delete();
        
                // Redirigir a la página deseada después de eliminar el elemento
                return redirect()->route('afegir1.index');
    }
}
