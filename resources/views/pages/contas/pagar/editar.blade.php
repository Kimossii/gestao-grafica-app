@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-6">Editar Conta a Pagar</h2>

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

    <form action="{{ route('contas.update.pagar', $conta->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição <span class="text-red-500">*</span></label>
            <input type="text" name="descricao" id="descricao"
                value="{{ old('descricao', $conta->descricao) }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label for="valor" class="block text-sm font-medium text-gray-700">Valor <span class="text-red-500">*</span></label>
            <input type="number" step="0.01" name="valor" id="valor"
                value="{{ old('valor', $conta->valor) }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label for="data_vencimento" class="block text-sm font-medium text-gray-700">Data de Vencimento <span class="text-red-500">*</span></label>
            <input type="date" name="data_vencimento" id="data_vencimento"
                value="{{ old('data_vencimento', $conta->data_vencimento ? date('Y-m-d', strtotime($conta->data_vencimento)) : '') }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label for="data_pagamento" class="block text-sm font-medium text-gray-700">Data de Pagamento</label>
            <input type="date" name="data_pagamento" id="data_pagamento"
                value="{{ old('data_pagamento', $conta->data_pagamento ? date('Y-m-d', strtotime($conta->data_pagamento)) : '') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label for="fornecedor_id" class="block text-sm font-medium text-gray-700">Fornecedor <span class="text-red-500">*</span></label>
            <select name="fornecedor_id" id="fornecedor_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Selecione um fornecedor</option>
                @foreach ($fornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}"
                        {{ old('fornecedor_id', $conta->fornecedor_id) == $fornecedor->id ? 'selected' : '' }}>
                        {{ $fornecedor->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
            <textarea name="observacoes" id="observacoes" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('observacoes', $conta->observacoes) }}</textarea>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
            <select name="status" id="status" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Selecione</option>
                <option value="pendente" {{ old('status', $conta->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="pago" {{ old('status', $conta->status) == 'pago' ? 'selected' : '' }}>Pago</option>
            </select>
        </div>

        <button type="submit"
            class="inline-flex justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
            Atualizar
        </button>
    </form>
</div>
@endsection
