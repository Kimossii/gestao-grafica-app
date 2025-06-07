<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Fatura;
use App\Models\FaturaItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class FaturaController extends Controller
{
    //
    public function index()
    {
        return view('pages.faturas.index');
    }

    public function faturaCadastrar()
    {
        $servicos = Servico::where('status', 'ativo')->get();
        $produtos = Produto::where('status', 'ativo')->get();
        $clientes = Cliente::where('status', 'ativo')->get();
        return view('pages.faturas.fatura.cadastrar', compact('servicos', 'produtos', 'clientes'));
    }
    public function faturaReciboCadastrar()
    {
        $servicos = Servico::where('status', 'ativo')->get();
        $produtos = Produto::where('status', 'ativo')->get();
        $clientes = Cliente::where('status', 'ativo')->get();
        return view('pages.faturas.faturarecibo.cadastrar', compact('servicos', 'produtos', 'clientes'));
    }
    public function faturaStore(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens' => 'required|array|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        $dataAtual = Carbon::now();
        // Gerar número sequencial
        $ultimoNumero = Fatura::max('id'); // ou use max('numero') se for numérico
        $numeroFatura = 'FT-' . str_pad($ultimoNumero + 1, 5, '0', STR_PAD_LEFT); // Ex: FT-00001

        // Criar a fatura
        $fatura = Fatura::create([
            'cliente_id' => $request->cliente_id,
            'numero' => $numeroFatura,
            'total' => $request->total,
            'data_emissao' => $dataAtual,
            'status' => 'pendente',
            'tipo' => 'fatura',
            'user_id' => auth()->id(),
        ]);

        // Criar os itens
        foreach ($request->itens as $item) {
            $tipo = $item['tipo'];
            $id = explode('-', $item['id'])[1] ?? null;
            if ($id) {
                FaturaItem::create([
                    'fatura_id' => $fatura->id,
                    'preco_unitario' => $item['preco_base'],
                    'subtotal' => $item['subtotal'],
                    'item_id' => $id,
                    'item_tipo' => $item['tipo'],
                    'quantidade' => $item['quantidade'],
                    'nome' => $item['nome'] ?? null,
                ]);
            }
        }


        return redirect()->route('faturas.fatura.cadastrar')->with('success', 'Fatura criada com sucesso!');
    }

    public function faturaReciboStore(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens' => 'required|array|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        $dataAtual = Carbon::now();
        // Gerar número sequencial
        $ultimoNumero = Fatura::max('id'); // ou use max('numero') se for numérico
        $numeroFatura = 'FR-' . str_pad($ultimoNumero + 1, 5, '0', STR_PAD_LEFT); // Ex: FT-00001

        // Criar a fatura
        $fatura = Fatura::create([
            'cliente_id' => $request->cliente_id,
            'numero' => $numeroFatura,
            'metodo_pagamento' => $request->metodo_pagamento,
            'data_emissao' => $dataAtual,
            'total' => $request->total,
            'status' => 'pago',
            'tipo' => 'fatura-recibo',
            'user_id' => auth()->id(),
        ]);

        // Criar os itens
        foreach ($request->itens as $item) {
            $tipo = $item['tipo'];
            $id = explode('-', $item['id'])[1] ?? null;
            if ($id) {
                FaturaItem::create([
                    'fatura_id' => $fatura->id,
                    'preco_unitario' => $item['preco_base'],
                    'subtotal' => $item['subtotal'],
                    'item_id' => $id,
                    'item_tipo' => $item['tipo'],
                    'quantidade' => $item['quantidade'],
                    'nome' => $item['nome'] ?? null,
                ]);
            }
        }


        return redirect()->route('faturas.faturarecibo.cadastrar')->with('success', 'Fatura Recibo criada com sucesso!');
    }

    public function faturaListar()
    {
        $faturas = Fatura::where('status', 'pendente')->where('tipo', 'fatura')
            ->with(['cliente', 'itens.item'])
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('pages.faturas.fatura.listar', compact('faturas'));
    }
    public function faturaDetalhe($id)
    {
        $fatura = Fatura::with(['cliente', 'itens.item'])->findOrFail($id);
        return view('pages.faturas.fatura.detalhe', compact('fatura'));
    }

    public function gerarFatura(Fatura $fatura)
    {
        $pdf = Pdf::loadView('pages.faturas.fatura.pdf', compact('fatura'));
        return $pdf->stream("fatura-{$fatura->numero}.pdf");

    }
    public function faturaReciboListar()
    {
        $faturas = Fatura::where('tipo', 'fatura-recibo')
            ->with(['cliente', 'itens.item'])
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('pages.faturas.faturarecibo.listar', compact('faturas'));
    }
    public function faturaReciboDetalhe($id)
    {
        $fatura = Fatura::with(['cliente', 'itens.item'])->findOrFail($id);
        return view('pages.faturas.faturarecibo.detalhe', compact('fatura'));
    }

    public function gerarFaturarecibo(Fatura $fatura)
    {
        $pdf = Pdf::loadView('pages.faturas.faturarecibo.pdf', compact('fatura'));
        return $pdf->stream("fatura-{$fatura->numero}.pdf");

    }

    //Recibo das faturas já feitas
    public function reciboListar(){
         $faturas = Fatura::where('status', 'pendente')->where('tipo', 'fatura')
            ->with(['cliente', 'itens.item'])
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('pages.faturas.recibo.list', compact('faturas'));
    }
    public function reciboDetalhe($id)
    {
        $fatura = Fatura::with(['cliente', 'itens.item'])->findOrFail($id);
        return view('pages.faturas.recibo.detalhe', compact('fatura'));
    }
    public function reciboPagar($id)
    {
        $fatura = Fatura::with(['cliente', 'itens.item'])->findOrFail($id);
        if ($fatura->status !== 'pendente') {
            return redirect()->route('faturas.recibo.listar')->with('error', 'Fatura não está pendente para pagamento.');
        }
        return view('pages.faturas.recibo.pagar', compact('fatura'));
    }
    public function reciboStore(Request $request, $id)
    {
        $request->validate([
            'metodo_pagamento' => 'required|string|max:255',
        ]);

        $fatura = Fatura::findOrFail($id);
        if ($fatura->status !== 'pendente') {
            return redirect()->route('faturas.recibo.listar')->with('error', 'Fatura não está pendente para pagamento.');
        }

        $fatura->update([
            'tipo' => 'fatura-recibo',
            'metodo_pagamento' => $request->metodo_pagamento,
            'status' => 'pago',
            'data_emissao' => Carbon::now(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('faturas.faturarecibo.detalhe',$id)->with('success', 'Fatura paga com sucesso!');
    }
}
