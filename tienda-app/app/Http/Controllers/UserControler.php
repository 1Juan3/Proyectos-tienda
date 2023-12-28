<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
class UserControler extends Controller
{

    public function index(){
    
        // $users = User::all();
       $users = User::with('roles')->get();
       
        return view('usuarios.crear',compact('users'));
    }
    public function store(Request $request)
    {
        $tiendaId = session('tienda_seleccionada');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username'=> $request->username,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('users')->with('success', 'Usuario creado exitosamente');
}

public function asignarRolIndex($id){

    $user = User::find($id);
    $roles = Role::all()->pluck('name');
    
    return view('usuarios.asignarrol',compact('user','roles', 'id'));
}
public function asignarRol(Request $request, $id){

    $user = User::find($id);
   
    $user->assignRole($request->rol);
    return redirect()->route('users')->with('success', 'Rol asignado exitosamente');
}
}
