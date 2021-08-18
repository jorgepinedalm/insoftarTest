<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
    /**
     * 
     */
    function list(Request $request){
        $usuarios = Usuario::get();
        return response()->json($usuarios);
    }

    function create(Request $request){
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|unique:users,email|email',
            'cardID' => 'required|unique:users,cardID|numeric',
            'phone' => 'required|numeric'
        ]);
        
        $usuario = Usuario::create($request->all());
        
        //return response()->json($usuario);
        return response()->json($usuario, 201);
    }

    function edit(Request $request, $id){
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'cardID' => 'required|numeric|unique:users,cardID,'.$id,
            'phone' => 'required|numeric'
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->firstname = $request->firstname;
        $usuario->lastname = $request->lastname;
        $usuario->email = $request->email;
        $usuario->cardID = $request->cardID;
        $usuario->phone = $request->phone;

        $usuario->save();

        return response()->json($usuario, 200);
    }

    function delete(Request $request, $id){
        $usuario = Usuario::findOrFail($id);
        $temp = $usuario;
        $usuario->delete();

        return response()->json($temp, 201);
    }
}
