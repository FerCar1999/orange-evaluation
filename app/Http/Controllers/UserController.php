<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecoveryPasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Mail\RecoveryPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $model)
    {
        $this->middleware('auth:api',['except'=>['recoveryPassword','checkRecovery']]);
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
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        if ($this->model->create($validated)) {
            return response()->json(['message' => 'Usuario creado con exito'], 201);
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

    public function recoveryPassword(RecoveryPasswordRequest $request)
    {
        $validated = $request->validated();
        $user = $this->model->where('email', $validated['email'])->first();
        if ($user) {
            $token = Str::random(40);
            //generando registro en password_reset
            DB::table('password_resets')->insert(['email' => $user->email, 'token' => $token, 'created_at' => Carbon::now()]);
            $recovery = array(
                'name' => $user->name,
                'token' => $token
            );
            //enviando correo
            Mail::to($user->email)->queue(new RecoveryPasswordMail($recovery));
            return response()->json(['message' => 'Correo de recuperacion enviado con exito'], 200);
        } else {
            return response()->json(['message' => 'No se ha encontrado el usuario'], 400);
        }
    }

    public function checkRecovery($token)
    {
        if ($token != null) {
            $record = DB::table('password_resets')->where('token', $token)->latest()->first();
            $diff_time = Carbon::parse($record->created_at)->diffInMinutes(Carbon::now());
            if ($diff_time > 15) {
                return response()->json(['error' => 'Token caducado'], 401);
            } else {
                return response()->json(['message' => 'Token activo'], 200);
            }
        }
        return response()->json(['error' => 'No se ha encontrado el token'], 400);
    }
}
