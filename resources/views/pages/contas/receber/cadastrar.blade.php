@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Cadastrar Conta a Receber</h2>

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

        <form action="{{ route('contas.store.receber') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição <span class="text-red-500">*</span></label>
                <input type="text" name="descricao" id="descricao" value="{{ old('descricao') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="valor" class="block text-sm font-medium text-gray-700">Valor <span class="text-red-500">*</span></label>
                <input type="number" step="0.01" name="valor" id="valor" value="{{ old('valor') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="data_vencimento" class="block text-sm font-medium text-gray-700">Data de Vencimento <span class="text-red-500">*</span></label>
                <input type="date" name="data_vencimento" id="data_vencimento" value="{{ old('data_vencimento') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="data_recebimento" class="block text-sm font-medium text-gray-700">Data de Recebimento</label>
                <input type="date" name="data_recebimento" id="data_recebimento" value="{{ old('data_recebimento') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="cliente_id" class="block text-sm font-medium text-gray-700">Cliente <span class="text-red-500">*</span></label>
                <select name="cliente_id" id="cliente_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Selecione um cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="observacoes" class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea name="observacoes" id="observacoes" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('observacoes') }}</textarea>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                <select name="status" id="status" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Selecione</option>
                    <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="recebido" {{ old('status') == 'recebido' ? 'selected' : '' }}>Recebido</option>
                </select>
            </div>

            <button type="submit"
                class="inline-flex justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                Cadastrar
            </button>
        </form>
    </div>
@endsection
