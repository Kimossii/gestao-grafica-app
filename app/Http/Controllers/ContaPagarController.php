<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaPagar;
use App\Models\Fornecedor;

class ContaPagarController extends Controller
{
    //
    public function index(){
        $contas= ContaPagar::paginate(10);
        return view('pages.contas.pagar.index', compact('contas'));
    }
    public function cadastrar()
    {
        $fornecedores = Fornecedor::all();
        return view('pages.contas.pagar.cadastrar', compact('fornecedores'));
    }
    public function store(Request $request)
    {
        $validation = $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
            'data_pagamento' => 'nullable|date',
            'fornecedor_id' => 'required|exists:fornecedores,id',
        ]);

        $conta = ContaPagar::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_vencimento' => $request->data_vencimento,
            'data_pagamento' => $request->data_pagamento,
            'fornecedor_id' => $request->fornecedor_id,
            'status' => 'pendente',
            'observacoes' => $request->observacoes,
        ]);

        return back()->with('success', 'Conta a pagar cadastrada com sucesso!');
    }
    public function editar($id)
    {
        $conta = ContaPagar::findOrFail($id);
        $fornecedores = Fornecedor::all();
        return view('pages.contas.pagar.editar', compact('conta', 'fornecedores'));
    }
    public function update(Request $request, $id)
    {
        $conta = ContaPagar::findOrFail($id);
        $validation = $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
            'data_pagamento' => 'nullable|date',
            'fornecedor_id' => 'required|exists:fornecedores,id',
        ]);

        $conta->update([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_vencimento' => $request->data_vencimento,
            'data_pagamento' => $request->data_pagamento,
            'fornecedor_id' => $request->fornecedor_id,
            'status' => $request->status,
            'observacoes' => $request->observacoes,
        ]);

        return back()->with('success', 'Conta a pagar atualizada com sucesso!');
    }
    public function destroy($id)
    {
        $conta = ContaPagar::findOrFail($id);
        $conta->delete();
        return back()->with('success', 'Conta a pagar excluída com sucesso!');
    }
}
