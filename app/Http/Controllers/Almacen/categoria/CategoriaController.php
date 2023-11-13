<?php

namespace App\Http\Controllers\Almacen\categoria;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public  function  __construct()
    {

    }


    public function index(Request $request)
    {
        //
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $categorias=DB::table('Categorias')->where('Categoria', 'LIKE', '%' .$query. '%')
                ->where('Estatus', '=' , '1')
                ->orderBy('Id_categoria', 'desc')
                ->paginate(8);
            return view('Almacen.categoria.index', ["Categoria"=>$categorias, "searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Almacen.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Categ = new Categoria;
        $Categ->Categoria=$request->get('Categoria');
        $Categ->Descripcion= $request->get('Descripcion');
        $Categ->Estatus='1';
        $Categ->save();
        return Redirect::to('Almacen/categoria');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("Almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("Almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $catedit=Categoria::findOrFail($id);
        $catedit->Categoria=$request->get('categoria');
        $catedit->Descripcion=$request->get('descripcion');
        $catedit->update();
        return Redirect::to('Almacen/categoria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catDel=Categoria::findOrFail($id);
        $catDel->Estatus='0';
        $catDel->update();
        return Redirect::to('Almacen/categoria');
    }
}
