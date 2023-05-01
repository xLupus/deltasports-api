<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoriaResource;
use App\Http\Resources\Api\ProdutoResource;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categoria::ativos()->get();

        return response()->json([
            'status'        => 200,
            'message'       => 'Categorias retornadas com sucesso!',
            'data'          => [
                'categories' => CategoriaResource::collection($categories)
            ]
        ]);
    }

    /**
     * Display the products from a specified resource.
     */
    public function showProducts(Request $request)
    {
        $categoriaId = $request->id;

        $produtos = Produto::ativos()->where('CATEGORIA_ID', $categoriaId)->get();

        return response()->json([
            'status'  => 200,
            'message' => 'Produtos da categoria retornados com sucesso!',
            'data'    => ProdutoResource::collection($produtos)
        ]);
    }
}
