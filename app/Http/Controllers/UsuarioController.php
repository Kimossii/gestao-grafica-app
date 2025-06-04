<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    //
    public function index()
    {
        $usuarios = User::paginate(10);
        return view('pages.usuarios.index', compact('usuarios'));
    }
    public function cadastrar()
    {
        return view('pages.usuarios.cadastrar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'perfil' => 'required|in:vendedor,admin',
            'status' => 'required|in:ativo,inativo',
            'telefone' => 'nullable|string|max:20',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'perfil' => $request->perfil, // ou 'perfil'
            'status' => $request->status,
            'telefone' => $request->telefone,
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Usuário cadastrado com sucesso!');
    }
    public function editar($id)
    {
        $usuario = User::findOrFail($id);
        return view('pages.usuarios.editar', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'perfil' => 'required|in:vendedor,admin',
            'status' => 'required|in:ativo,inativo',
            'telefone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'perfil' => $request->perfil,
            'status' => $request->status,
            'telefone' => $request->telefone,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('usuarios.editar',$id)->with('success', 'Usuário atualizado com sucesso!');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('usuarios.listar')->with('success', 'Usuário excluído com sucesso!');
    }


}
