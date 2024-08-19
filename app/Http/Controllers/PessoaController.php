<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pessoa::paginate();
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
        $pessoa = Pessoa::create($request->all());
        return response()->json($pessoa, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return Pessoa::findOrFail($id);
        } catch (ModelNotFoundException $modelException) {
            return response()->json(["error"=>true], 404);
        }
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
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update($request->all());
        return response()->json($pessoa, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->delete();
        return response()->json(null, 204);
    }
}
