<?php

namespace App\Http\Controllers;

use App\Models\Tenista;
use App\Models\Torneo;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TorneoController extends Controller
{
    /**
     * funcion para pasar el listado de torneos a la vista con paginacion y un shecr para buscar
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $torneos = Torneo::where('isDelete', false);

        if ($search) {
            $torneos->where('nombre', 'LIKE', "%{$search}%");
        }

        $torneos = $torneos->paginate(10);
        $topThreeTorneos = Torneo::where('isDelete', false)->orderBy('premios', 'desc')->take(3)->get();
        $topTenTorneos = Torneo::where('isDelete', false)->orderBy('premios', 'desc')->limit(10)->get();

        return view('torneo.index', compact('torneos', 'topThreeTorneos', 'topTenTorneos'));
    }

    /**
     * funcion para guardar un torneo en la base de datos
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'modalidad' => 'required|in:individual,dobles,mixto',
            'superficie' => 'required|in:dura,arcilla,hierba',
            'vacantes' => 'required|integer',
            'categoria' => 'required|in:atp 250,atp 500,atp 1000',
            'premios' => 'required|integer',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'imagen' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $torneo = new Torneo($request->all());

            if ($request->hasFile('imagen')) {
                $torneo->imagen = $request->file('imagen')->store('public/torneos');
            } else {
                $torneo->imagen = 'default.jpg';  // O cualquier valor por defecto que uses
            }

            $torneo->save();
            Session::flash('success', 'Torneo creado con éxito.');
            return redirect()->route('torneos.index')->with('success', 'Torneo creado con éxito');
        } catch (Exception $e) {
            Session::flash('error', 'Error al crear el torneo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al crear el torneo: ' . $e->getMessage());
        }
    }

    /**
     * funcion para mostrar el formulario de creacion de torneos
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('torneo.create');
    }

    /**
     * funcion para mostrar un torneo en especifico
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info('ID recibido: ' . $id);

        if (!Str::isUuid($id)) {
            return redirect()->route('torneos.index')->with('error', 'ID de torneo no válido.   ' . $id);
        }

        try {
            $torneo = Torneo::findOrFail($id);
            return view('torneo.show', compact('torneo'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('torneos.index')->with('error', 'Torneo no encontrado.');
        }
    }

    /**
     * funcion para mostrar el formulario de edicion de torneos
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $torneo = Torneo::findOrFail($id);
        return view('torneo.edit', compact('torneo'));
    }

    /**
     * funcion para actualizar un torneo en la base de datos
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $torneo = Torneo::find($id);

        if (!$torneo) {
            return redirect()->route('torneos.index')->with('error', 'Torneo no encontrado.');
        }

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'modalidad' => 'required|string|max:255',
            'superficie' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'vacantes' => 'required|integer',
            'premios' => 'required|numeric',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
        ]);

        try {
            $torneo->update($validatedData);

            if ($request->hasFile('imagen')) {
                $request->validate([
                    'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if (Storage::exists('public/' . $torneo->imagen)) {
                    Storage::delete('public/' . $torneo->imagen);
                }

                $imagen = $request->file('imagen');
                $extension = $imagen->getClientOriginalExtension();
                $fileToSave = Str::uuid() . '.' . $extension;
                $torneo->imagen = $imagen->storeAs('torneos', $fileToSave, 'public');
                $torneo->save();
            }

            return redirect()->route('torneos.index')->with('success', 'Torneo actualizado con éxito.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el torneo: ' . $e->getMessage());
        }
    }

    public function inscribir($id, Request $request)
    {
        $torneo = Torneo::findOrFail($id);

        $search = $request->input('search');
        $tenistas = Tenista::where('nombre', 'like', '%' . $search . '%')
            ->orWhere('apellido', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('torneo.inscribir', compact('torneo', 'tenistas'));
    }

    public function inscribirTenista(Request $request, $id)
    {
        $torneo = Torneo::findOrFail($id);
        $tenista_id = $request->input('tenista_id');

        if ($torneo->tenistas->contains($tenista_id)) {
            return redirect()->back()->with('error', 'El tenista ya está inscrito en este torneo.');
        }

        $torneo->tenistas()->attach($tenista_id, ['estado' => 'inscrito']);

        return redirect()->back()->with('success', 'Tenista inscrito correctamente.');
    }

    public function finalizar($id)
    {
        $torneo = Torneo::findOrFail($id);
        $tenistas = $torneo->tenistas;

        $tenistas = $tenistas->sortByDesc('puntos');

        $premios = [50, 20, 10, 10, 10, 0];
        $puntos = [100, 50, 25, 15, 10, 0];

        $i = 0;
        foreach ($tenistas as $tenista) {
            $tenista->totalDineroGanado += $premios[$i] ?? 0;
            $tenista->puntos += $puntos[$i] ?? 0;
            $tenista->save();
            $i++;
        }

        $torneo->tenistas()->detach();

        $torneo->isDelete = true;
        $torneo->save();

        return redirect()->route('torneos.index')->with('success', 'Torneo finalizado y tenistas eliminados correctamente.');
    }


    /**
     * funcion para eliminar un torneo en la base de datos
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Log::info('ID recibido para eliminar: ' . $id);

        if (!Str::isUuid($id)) {
            return redirect()->route('torneos.index')->with('error', 'ID de torneo no válido: ' . $id);
        }

        $torneo = Torneo::where('id', $id)->first();

        if (!$torneo) {
            return redirect()->route('torneos.index')->with('error', 'Torneo no encontrado con ID: ' . $id);
        }

        try {
            $torneo->isDelete = true;
            $torneo->save();
            return redirect()->route('torneos.index')->with('success', 'Torneo eliminado con éxito.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el torneo: ' . $e->getMessage());
        }
    }

    /**
     * funcion para mostrar los torneos eliminados
     *
     * @return \Illuminate\Http\Response
     */

    public function deleted()
    {
        $torneos = Torneo::where('isDelete', true)->get();
        return view('torneo.deleted', compact('torneos'));
    }

    /**
     * funcion para restaurar un torneo eliminado
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        // Log the ID to debug
        Log::info('ID recibido para restaurar: ' . $id);

        // Validar que el ID es un UUID válido
        if (!Str::isUuid($id)) {
            Log::error('ID no válido: ' . $id);
            return redirect()->route('torneos.deleted')->with('error', 'ID de torneo no válido: ' . $id);
        }

        try {
            $torneo = Torneo::where('id', $id)->first();
            Log::info('Torneo encontrado: ' . json_encode($torneo));

            if (!$torneo) {
                Log::error('Torneo no encontrado: ' . $id);
                return redirect()->route('torneos.deleted')->with('error', 'Torneo no encontrado con ID: ' . $id);
            }

            $torneo->isDelete = false;
            $torneo->save();

            Log::info('Torneo restaurado: ' . $id);
            Session::flash('success', 'Torneo recuperado con éxito.');
            return redirect()->route('torneos.deleted');
        } catch (Exception $e) {
            Log::error('Error al restaurar el torneo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al restaurar el torneo: ' . $e->getMessage());
        }
    }

}
