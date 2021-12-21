<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        if ($this->model->create($validated)) {
            return response()->json(['message' => 'Producto creado con exito'], 201);
        } else {
            return response()->json(['message' => 'Error al crear el producto'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $validated = $request->validated();
        if ($this->model->findOrFail($id)->update($validated)) {
            return response()->json(['message' => 'Producto modificado con exito'], 200);
        } else {
            return response()->json(['message' => 'Error al modificar el producto'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->model->findOrFail($id)->delete()) {
            return response()->json(['message' => 'Producto eliminado con exito'], 200);
        } else {
            return response()->json(['message' => 'Error al eliminar el producto'], 400);
        }
    }

    public function findByKey($key)
    {
        return Product::where('name', 'like', '%' . $key . '%')
            ->orWhere('sku', 'like', '%' . $key . '%')
            ->paginate(5);
    }
}
