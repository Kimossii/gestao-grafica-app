<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaReceber;
use App\Models\Cliente;

class ContaReceberController extends Controller
{
    //
    public function indexContas()
    {
        return view('pages.contas.index');
    }
    public function cadastrar()
    {
        $clientes = Cliente::all();
        return view('pages.contas.receber.cadastrar', compact('clientes'));
    }
    public function store(Request $request){
        $validation = $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
            'data_recebimento' => 'nullable|date',
            'cliente_id' => 'required|exists:clientes,id',
        ]);
        $conta = ContaReceber::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_vencimento' => $request->data_vencimento,
            'data_recebimento' => $request->data_recebimento,
            'cliente_id' => $request->cliente_id,
            'status' => 'pendente',
            'observacoes' => $request->observacoes,
        ]);
        return back()->with('success', 'Conta a receber cadastrada com sucesso!');
    }
    public function editar($id)
    {
        $conta = ContaReceber::findOrFail($id);
        $clientes = Cliente::all();
        return view('pages.contas.receber.editar', compact('conta', 'clientes'));
    }
    public function update(Request $request, $id)
    {
        $conta = ContaReceber::findOrFail($id);
        $validation = $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
            'data_recebimento' => 'nullable|date',
            'cliente_id' => 'required|exists:clientes,id',
        ]);
        $conta->update([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_vencimento' => $request->data_vencimento,
            'data_recebimento' => $request->data_recebimento,
            'cliente_id' => $request->cliente_id,
            'status' => $request->status,
            'observacoes' => $request->observacoes,
        ]);
        return redirect()->route('contas.listar.receber')->with('success', 'Conta a receber atualizada com sucesso!');
    }
    public function index()
    {
        $contas = ContaReceber::paginate(10);
        return view('pages.contas.receber.index', compact('contas'));
    }
    public function destroy($id)
    {
        $conta = ContaReceber::findOrFail($id);
        $conta->delete();
        return redirect()->route('contas.listar.receber')->with('success', 'Conta a receber excluída com sucesso!');
    }
}
