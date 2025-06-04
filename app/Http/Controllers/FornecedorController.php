<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    //
    public function listar()
    {
        $fornecedores = Fornecedor::paginate(10);
        return view('pages.fornecedores.listar', compact('fornecedores'));
    }
    public function cadastrar()
    {
        return view('pages.fornecedores.cadastrar');
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:fornecedores,email',
            'telefone' => 'nullable|string|max:20',
            'nif' => 'nullable|string|max:50',
            'endereco' => 'nullable|string|max:500',
        ]);

        // Criação do Fornecedor
        Fornecedor::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'nif' => $request->nif,
            'endereco' => $request->endereco,
        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('fornecedores.cadastrar')->with('success', 'Fornecedor cadastrado com sucesso!');
    }
     public function editar($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('pages.fornecedores.editar', compact('fornecedor'));
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
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'nif' => $request->nif,
            'endereco' => $request->endereco,
            'status' => $request->status,
        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('fornecedores.editar', $id)->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('fornecedores.listar')->with('success', 'Fornecedor excluído com sucesso!');
    }
}
