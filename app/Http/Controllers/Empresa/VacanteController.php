<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVacanteRequest;
use App\Models\Carrera;

class VacanteController extends Controller
{
    

    public function index()
    {
        $vacantes = auth()->user()->empresa->vacantes()
            ->withCount('postulaciones')
            ->latest()
            ->get();

        return view('empresa.vacantes.index', compact('vacantes'));
    }

    public function create()
    {
        $carreras = Carrera::orderBy('nombre')->get();

        return view('empresa.vacantes.create', compact('carreras'));
    }

    public function store(StoreVacanteRequest $request)
    {
        $vacante = $request->user()->empresa->vacantes()->create($request->validated());

        $vacante->carreras()->sync($request->carreras);

        return redirect()->route('empresa.vacantes.index')
            ->with('status', 'Vacante creada como borrador.');
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
