<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fatura;
use Carbon\Carbon;

class FluxoCaixaController extends Controller
{
    //
    public function index()
    {
        $periodos = [
            'diario' => Carbon::today(),
            'semanal' => Carbon::now()->startOfWeek(),
            'mensal' => Carbon::now()->startOfMonth(),
            'trimestral' => Carbon::now()->subMonths(3),
            'anual' => Carbon::now()->startOfYear(),
        ];

        $totais = [];

        foreach ($periodos as $nome => $dataInicial) {
            $totais[$nome] = Fatura::where('tipo', 'fatura-recibo')->where('status', 'pago')->whereDate('updated_at', '>=', $dataInicial)->sum('total');
        }

        return view('pages.caixa.index', compact('totais'));
    }
}
