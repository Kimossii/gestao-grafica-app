@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Lista de Contas a Pagar</h2>
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                        onclick="this.parentElement.remove()">
                        <i class="fa-solid fa-times text-green-700"></i>
                    </button>
                </div>
            @endif

            @if ($contas->isEmpty())
                <p class="text-gray-600">Nenhuma conta encontrada.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">Descrição</th>
                                <th class="px-4 py-2 border">Valor</th>
                                <th class="px-4 py-2 border">Data Vencimento</th>
                                <th class="px-4 py-2 border">Data Pagamento</th>
                                <th class="px-4 py-2 border">Fornecedor</th>
                                <th class="px-4 py-2 border">Observações</th>
                                <th class="px-4 py-2 border">Estado</th>
                                <th class="px-4 py-2 border">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contas as $conta)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $conta->descricao }}</td>
                                    <td class="px-4 py-2 border">{{ number_format($conta->valor, 2, ',', '.') }} KZ</td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($conta->data_vencimento)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ $conta->data_pagamento ? \Carbon\Carbon::parse($conta->data_pagamento)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $conta->fornecedor->nome ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 border">{{ $conta->observacoes }}</td>
                                    <td class="px-4 py-2 border">{{ ucfirst($conta->status) }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('contas.editar.pagar', $conta->id) }}"
                                            class="text-blue-600 hover:underline">Editar</a>
                                        <span class="mx-2">|</span>
                                        <form action="{{ route('contas.excluir.pagar', $conta->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $contas->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
