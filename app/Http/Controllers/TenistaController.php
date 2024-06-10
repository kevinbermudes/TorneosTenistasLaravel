<?php

namespace App\Http\Controllers;

use App\Models\Tenista;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TenistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $orderByRanking = $request->input('order_by_ranking');
        $query = Tenista::query();

        if ($search) {
            $query->where('nombre', 'like', '%' . $search . '%')
                ->orWhere('apellido', 'like', '%' . $search . '%')
                ->orWhere('pais', 'like', '%' . $search . '%');
        }

        if ($orderByRanking) {
            $query->orderBy('ranking', 'asc');
        }

        $tenistas = $query->paginate(7);
        $topThreeTenistas = Tenista::orderBy('ranking', 'asc')->take(3)->get();
        $topTenTenistas = Tenista::orderBy('ranking', 'asc')->take(10)->get();

        return view('tenista.index', compact('tenistas', 'topThreeTenistas', 'topTenTenistas'));
    }

    /**
     * funcion para devolver una vista de tenista
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Convertir el id a integer para asegurar que sea numérico
        $tenista = Tenista::findOrFail((int)$id);
        $torneos = $tenista->torneos;
        $carouselTenistas = Tenista::orderBy('ranking')->limit(3)->get();
        $topTenTenistas = Tenista::orderBy('ranking')->limit(10)->get();

        return view('tenista.show', compact('tenista', 'torneos', 'carouselTenistas', 'topTenTenistas'));
    }

    /**
     * funcion para crear un tenista
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topThreeTenistas = Tenista::orderBy('ranking', 'asc')->take(3)->get();
        $topTenTenistas = Tenista::orderBy('ranking', 'asc')->take(10)->get();

        return view('tenista.create', compact('topThreeTenistas', 'topTenTenistas'));
    }

    /**
     * funcion para editar un tenista
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tenista = $this->getTenista($id);
        Cache::put('tenista' . $id, $tenista, 300);

        $topThreeTenistas = Tenista::orderBy('ranking', 'asc')->take(3)->get();
        $topTenTenistas = Tenista::orderBy('ranking', 'asc')->take(10)->get();
        $tenistas = Tenista::all();
        return view('tenista.edit', compact('tenista', 'topThreeTenistas', 'topTenTenistas', 'tenistas'));
    }

    /*  funcion para obtener un tenista
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getTenista($id)
    {
        return Tenista::find($id);
    }

    /**
     * funcion para actualizar un tenista
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'FechaNacimiento' => 'required|date',
            'Altura' => 'required|numeric',
            'peso' => 'required|numeric',
            'Mano' => 'required|in:derecha,izquierda,ambidiestro',
            'reves' => 'required|in:una mano,dos manos',
            'entrenador' => 'required|string|max:255',
            'totalDineroGanado' => 'required|integer',
            'numeroVictorias' => 'required|integer',
            'numeroDerrortas' => 'required|integer',
            'puntos' => 'required|integer',
            'imagen' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $tenista = Tenista::findOrFail($id);

            // Calcular la edad a partir de la fecha de nacimiento
            $fechaNacimiento = \Carbon\Carbon::createFromFormat('Y-m-d', $validatedData['FechaNacimiento']);
            $validatedData['edad'] = intval($fechaNacimiento->diffInYears(now()));

            // Actualizar los datos del tenista
            $tenista->fill($validatedData);

            if ($request->hasFile('imagen')) {
                $tenista->imagen = $request->file('imagen')->store('public/tenistas');
            }

            $tenista->save();

            // Recalcular rankings
            Tenista::recalcularRankings();

            Session::flash('success', 'Tenista actualizado con éxito.');
            return redirect()->route('tenistas.index')->with('success', 'Tenista actualizado con éxito');
        } catch (Exception $e) {
            Session::flash('error', 'Error al actualizar el tenista: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar el tenista: ' . $e->getMessage());
        }
    }

    /**
     * funcion para almacenar un tenista
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'FechaNacimiento' => 'required|date',
            'Altura' => 'required|numeric',
            'peso' => 'required|numeric',
            'Mano' => 'required|in:derecha,izquierda,ambidiestro',
            'reves' => 'required|in:una mano,dos manos',
            'entrenador' => 'required|string|max:255',
            'totalDineroGanado' => 'required|integer',
            'numeroVictorias' => 'required|integer',
            'numeroDerrortas' => 'required|integer',
            'imagen' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'puntos' => 'required|integer',
        ]);

        try {
            // Calcular la edad a partir de la fecha de nacimiento
            $tenista = new Tenista($validatedData);
            $tenista->edad = $this->calcularEdad($request->input('FechaNacimiento')); // Calcular la edad antes de guardar

            // Crear el tenista
            $tenista->ranking = 0; // Valor inicial para ranking

            if ($request->hasFile('imagen')) {
                $tenista->imagen = $request->file('imagen')->store('public/tenistas');
            } else {
                $tenista->imagen = Tenista::$IMAGE_DEFAULT;
            }

            $tenista->save();

            // Recalcular rankings
            Tenista::recalcularRankings();

            Session::flash('success', 'Tenista creado con éxito.');
            return redirect()->route('tenistas.index');
        } catch (Exception $e) {
            Session::flash('error', 'Error al crear el tenista: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * funcion para calcular la edad de un tenista gracias a la fecha de nacimiento que nos pasan
     *
     * @param string $fechaNacimiento
     * @return int
     */

    public function calcularEdad($fechaNacimiento)
    {
        $fechaNacimiento = \Carbon\Carbon::createFromFormat('Y-m-d', $fechaNacimiento);
        return intval($fechaNacimiento->diffInYears(now()));
    }

    /**
     * funcion para eliminar un tenista
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tenista = $this->getTenista($id);

            if (!$tenista) {
                Session::flash('error', 'Tenista no encontrado.');
                return redirect()->back();
            }

            // Verificar si el tenista está en algún torneo
            if ($tenista->torneos()->count() > 0) {
                Session::flash('error', 'No se puede eliminar el tenista porque está participando en uno o más torneos. Para poder borrarlo, por favor comunicarse con el administrador del torneo para su descalificación.');
                return redirect()->back();
            }

            if ($tenista->imagen != 'https://via.placeholder.com/150' && Storage::exists('public/' . $tenista->imagen)) {
                Storage::delete('public/' . $tenista->imagen);
            }


            $tenista->delete();

            // Recalcular rankings
            Tenista::recalcularRankings();
            Cache::forget('tenista' . $id);

            Session::flash('success', 'Tenista eliminado con éxito.');
            return redirect()->route('tenistas.index');
        } catch (Exception $e) {
            Session::flash('error', 'Error al eliminar el tenista: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * funcion para editar la imagen de un tenista
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editImage($id)
    {
        $tenista = $this->getTenista($id);
        Cache::put('tenista' . $id, $tenista, 300);
        return view('tenista.image')->with('tenista', $tenista);
    }

    /**
     * funcion para actualizar la imagen de un tenista
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'file',
        ]);

        try {
            $tenista = $this->getTenista($id);

            if ($tenista->imagen != Tenista::$IMAGE_DEFAULT && Storage::exists('public/' . $tenista->imagen)) {
                Storage::delete('public/' . $tenista->imagen);
            }

            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $fileToSave = Str::uuid() . '.' . $extension;
            $tenista->imagen = $imagen->storeAs('tenistas', $fileToSave, 'public');
            $tenista->save();

            Cache::forget('tenista' . $id);

            Session::flash('success', 'Imagen del tenista actualizada con éxito.');
            return redirect()->route('tenistas.index');

        } catch (Exception $e) {
            Session::flash('error', 'Error al actualizar la imagen del tenista: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * funcion para recuperar un tenista
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function deleted()
    {
        $tenistas = Tenista::onlyTrashed()->get();
        return view('tenista.deleted', compact('tenistas'));
    }

    /**
     * funcion para recuperar un tenista
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function restore($id)
    {
        $tenista = Tenista::withTrashed()->findOrFail($id);
        $tenista->restore();
        Tenista::recalcularRankings();

        Session::flash('success', 'Tenista recuperado con éxito.');
        return redirect()->route('tenistas.deleted');
    }


}
