<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
  // Ver todos los registros
  public function index()
  {
    return User::paginate();
  }

  // Ver registro por id
  public function show($id)
  {
    return User::find($id);
  }

  // Guarder registros
  public function store(UserCreateRequest $request)
  {
    $user = User::create($request->only('first_name', 'last_name', 'email') + ['password' => Hash::make(1234)]);

    return response($user, Response::HTTP_CREATED);
  }

  // Actualizar registros
  public function update(UserUpdateRequest $request, $id)
  {
    $user = User::find($id);

    $user->update($request->only('first_name', 'last_name', 'email'));
    return response($user, Response::HTTP_ACCEPTED);
  }

  // Eliminar registro
  public function destroy($id)
  {
    User::destroy($id);
    return response(null, Response::HTTP_NO_CONTENT);
  }

  public function user()
  {
    return \Auth::user();
  }

  public function updateInfo(Request $request)
  {
    
  }
}
