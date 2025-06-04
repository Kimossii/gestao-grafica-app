<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;



class ClienteController extends Controller
{
    //
    public function cadastrar()
    {
        return view('pages.clients.cadastrar');
    }
    public function listar()
    {
        $clientes = Cliente::paginate(10);
        return view('pages.clients.listar', compact('clientes'));
    }
    public function store(Request $request)
{
    // Validação dos dados
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'nullable|email|max:255|unique:clientes,email',
        'telefone' => 'nullable|string|max:20',
        'nif' => 'nullable|string|max:50',
        'endereco' => 'nullable|string|max:500',
    ]);

    // Criação do cliente
    Cliente::create([
        'nome' => $request->nome,
        'email' => $request->email,
        'telefone' => $request->telefone,
        'nif' => $request->nif,
        'endereco' => $request->endereco,
    ]);

    // Redirecionamento com mensagem de sucesso
    return redirect()->route('clientes.cadastrar')->with('success', 'Cliente cadastrado com sucesso!');
}
    public function editar($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('pages.clients.editar', compact('cliente'));
    }
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.listar')->with('success', 'Cliente excluído com sucesso!');
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:fornecedores,email,' . $id,
            'telefone' => 'nullable|string|max:20',
            'nif' => 'nullable|string|max:50',
            'endereco' => 'nullable|string|max:500',
            'status' => 'nullable|string|max:50',
        ]);

        // Atualização do Fornecedor
        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'nif' => $request->nif,
            'endereco' => $request->endereco,
            'status' => $request->status,
        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('clientes.editar', $id)->with('success', 'Cliente atualizado com sucesso!');
    }
}
