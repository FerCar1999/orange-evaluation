<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $model)
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
        return $this->model->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();
        //Generando clave
        $password = Str::random(8);
        $validated['password'] = bcrypt($password);
        if ($this->model->create($validated)) {
            return response()->json(['message' => 'Usuario creado con exito', 'password' => $password], 201);
        } else {
            return response()->json(['error' => 'Error al crear el usuario'], 400);
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
    public function update(UpdateUserRequest $request, $id)
    {
        $validated = $request->validated();
        if ($this->model->find($id)->update([$validated])) {
            return response()->json(['message' => 'Usuario modificado con exito'], 200);
        } else {
            return response()->json(['error' => 'Error al modificar el usuario'], 400);
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
        if ($this->model->find($id)->delete()) {
            return response()->json(['message' => 'Usuario eliminado con exito'], 200);
        } else {
            return response()->json(['error' => 'Error al eliminar el usuario'], 400);
        }
    }
}
