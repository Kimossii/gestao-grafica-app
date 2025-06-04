@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Editar Serviço</h2>

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
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-times text-green-700"></i>
                </button>
            </div>
        @endif

        <form action="{{ route('servicos.update', $servico->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome <span class="text-red-500">*</span></label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $servico->nome) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea name="descricao" id="descricao" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descricao', $servico->descricao) }}</textarea>
            </div>
            <div>
                <label for="preco" class="block text-sm font-medium text-gray-700">Preço</label>
                <input type="number" step="0.01" name="preco" id="preco" value="{{ old('preco', $servico->preco) }}" placeholder="Preço"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="prazo_estimado" class="block text-sm font-medium text-gray-700">Prazo Estimado</label>
                <input type="number" name="prazo_estimado" id="prazo_estimado" value="{{ old('prazo_estimado', $servico->prazo_estimado) }}"
                    placeholder="Dias"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo <span class="text-red-500">*</span></label>
                <input type="text" name="tipo" id="tipo" value="{{ old('tipo', $servico->tipo) }}" placeholder="Categoria" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="ativo" {{ old('status', $servico->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                    <option value="inativo" {{ old('status', $servico->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>

            <button type="submit"
                class="inline-flex justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                Atualizar
            </button>
        </form>
    </div>
@endsection
