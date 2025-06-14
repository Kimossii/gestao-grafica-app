@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-600 rounded">
                    {{ session('success') }}
                </div>
            @endif


            <a href="{{ route('faturas.fatura.pdf', $fatura->id) }}" target="_blank"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Imprimir Fatura
            </a>

            <h2 class="text-2xl font-bold mb-4">Detalhes da Fatura - {{ $fatura->numero }}</h2>

            <div class="mb-6 space-y-2">
                <p><strong>Cliente:</strong> {{ $fatura->cliente->nome ?? 'N/A' }}</p>
                <p><strong>Data de Emissão:</strong> {{ \Carbon\Carbon::parse($fatura->updated_at)->format('d/m/Y') }}
                </p>
                <p><strong>Hora de Emissão:</strong>
                    {{ \Carbon\Carbon::parse($fatura->updated_at)->addHour()->format('H:i') }}
                </p>
                <p><strong>Estado:</strong> {{ ucfirst($fatura->status) }}</p>
            </div>

            <h3 class="text-xl font-semibold mb-2">Itens da Fatura</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Tipo</th>
                            <th class="px-4 py-2 border">Nome</th>
                            <th class="px-4 py-2 border">Quantidade</th>
                            <th class="px-4 py-2 border">Preço Unitário</th>
                            <th class="px-4 py-2 border">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fatura->itens as $item)
                            @php
                                $tipo = $item->item_tipo;
                                $entidade = $item->item;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 border">{{ ucfirst($tipo) }}</td>
                                <td class="px-4 py-2 border">{{ $item->nome ?? 'Item removido' }}</td>
                                <td class="px-4 py-2 border">{{ $item->quantidade }}</td>
                                <td class="px-4 py-2 border">{{ number_format($item->preco_unitario, 2, ',', '.') }} KZ
                                </td>
                                <td class="px-4 py-2 border font-semibold">
                                    {{ number_format($item->subtotal, 2, ',', '.') }} KZ</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-500">Nenhum item encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-right">
                <p class="text-lg font-bold">Total: {{ number_format($fatura->total, 2, ',', '.') }} KZ</p>
            </div>

            <div class="mt-4">
                <a href="{{ route('faturas.fatura.listar') }}"
                    class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">← Voltar</a>
            </div>
        </div>
    </div>
@endsection
