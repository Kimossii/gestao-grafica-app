@extends('layouts.app')
<style>
    .imprimir {
        color: #0074f8;
        text-decoration: none;
        font-weight: bold;
        margin-inline: 10px;
    }
    .imprimir:hover {
        color: #051527;
        text-decoration: underline;

    }
</style>
@section('content')
    <div class="max-w-7xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Lista de Faturas Emitidas</h2>

            @if ($faturas->isEmpty())
                <p class="text-gray-600">Nenhuma fatura foi emitida ainda.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">Nº</th>
                                <th class="px-4 py-2 border">Cliente</th>
                                <th class="px-4 py-2 border">Data</th>
                                <th class="px-4 py-2 border">Total</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Cadastrado por</th>
                                <th class="px-4 py-2 border">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faturas as $fatura)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2 border font-semibold">{{ $fatura->numero }}</td>
                                    <td class="px-4 py-2 border">{{ $fatura->cliente->nome ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($fatura->created_at)->format('d/m/Y-H:m') }}min</td>
                                    <td class="px-4 py-2 border">{{ number_format($fatura->total, 2, ',', '.') }} KZ</td>
                                    <td class="px-4 py-2 border">{{ ucfirst($fatura->status) }}</td>
                                    <td class="px-4 py-2 border">{{ $fatura->user->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{route('faturas.recibo.detalhe',$fatura->id)}}" class="text-blue-600 hover:underline">Ver detalhes</a>
                                        <a href="{{route('faturas.recibo.pagar',$fatura->id)}}" class="imprimir" title="Pagar a fatura">Imprimir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $faturas->links() }} {{-- Paginação --}}
                </div>
            @endif
        </div>
    </div>
@endsection
