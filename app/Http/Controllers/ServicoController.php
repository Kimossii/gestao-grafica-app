<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
class ServicoController extends Controller
{
    //
    public function listar()
    {
        $servicos = Servico::paginate(10);
        return view('pages.servicos.listar', compact('servicos'));
    }
    public function cadastrar()
    {
        return view('pages.servicos.cadastrar');
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255',
            'preco' => 'nullable|numeric|',
            'prazo_estimado' => 'nullable|integer',
            'tipo' => 'nullable|string|',
        ]);

        // Criação do Fornecedor
        Servico::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'prazo_estimado' => $request->prazo_estimado,
            'tipo' => $request->tipo,
            'preco' => $request->preco,
        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('servicos.cadastrar')->with('success', 'Serviço cadastrado com sucesso!');
    }

    public function editar($id)
    {
        $servico = Servico::findOrFail($id);
        return view('pages.servicos.editar', compact('servico'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255',
            'preco' => 'nullable|numeric|',
            'prazo_estimado' => 'nullable|integer',
            'tipo' => 'nullable|string|',
            'status' => 'nullable|string|max:50',
        ]);

        // Atualização do Fornecedor
        $servico = Servico::findOrFail($id);
        $servico->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'prazo_estimado' => $request->prazo_estimado,
            'tipo' => $request->tipo,
            'preco' => $request->preco,
            'status' => $request->status,
        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('servicos.editar', $id)->with('success', 'Servico atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $servico = Servico::findOrFail($id);
        $servico->delete();

        return redirect()->route('servicos.listar')->with('success', 'Serviço excluído com sucesso!');
    }
}
