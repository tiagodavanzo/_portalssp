<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        //return $usuarios;
        return response()->json($usuarios);
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        //return $usuario;
        return response()->json($usuario);
    }

    public function create(Request $request)
    {
        $usuario = new Usuario();

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->grupo = $request->grupo;
        $usuario->senha = $request->senha;

        $usuario->save();

        return response()->json('Usuário cadastrado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->grupo = $request->grupo;
        $usuario->senha = $request->senha;

        $usuario->save();

        return response()->json('Usuário atualizado com sucesso!');
    }

    public function delete($id)
    {
        $usuario = Usuario::find($id);
        $usuario->delete();

        return response()->json('Usuário excluído com sucesso!');
    }

    public function login(Request $request)
    {
        $usuario = new Usuario();

        $usuario->email = $request->email;
        $usuario->senha = sha1($request->senha);

        $usuario = Usuario::where('email', '=', $usuario->email)->where('senha', '=', $usuario->senha)->select('id', 'email', 'senha', 'grupo')->get();

        if(!is_null($usuario))
            return $usuario;
        else
            return response()->json('Email e/ou senha incorretos. Tente novamente.');
    }
}