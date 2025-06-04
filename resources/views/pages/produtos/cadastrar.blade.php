@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Cadastrar Produto</h2>

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

        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome <span
                        class="text-red-500">*</span></label>
                <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea name="descricao" id="descricao" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descricao') }}</textarea>
            </div>
            <div>
                <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoria <span
                        class="text-red-500">*</span></label>
                <select name="categoria_id" id="categoria_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="altura" class="block text-sm font-medium text-gray-700">Prazo Produção (dias)</label>
                <input type="number" step="0.01" name="prazo_producao" id="prazo_producao" value="{{ old('prazo_producao') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="preco_base" class="block text-sm font-medium text-gray-700">Preço Base <span
                        class="text-red-500">*</span></label>
                <input type="number" step="0.01" name="preco_base" id="preco_base" value="{{ old('preco_base') }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="largura" class="block text-sm font-medium text-gray-700">Largura (cm)</label>
                <input type="number" step="0.01" name="largura" id="largura" value="{{ old('largura') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="altura" class="block text-sm font-medium text-gray-700">Altura (cm)</label>
                <input type="number" step="0.01" name="altura" id="altura" value="{{ old('altura') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="quantidade_minima" class="block text-sm font-medium text-gray-700">Quantidade Mínima</label>
                <input type="number" name="quantidade_minima" id="quantidade_minima"
                    value="{{ old('quantidade_minima') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="prezo_producao" class="block text-sm font-medium text-gray-700">Preço Produção</label>
                <input type="number" step="0.01" name="prezo_producao" id="prezo_producao"
                    value="{{ old('prezo_producao') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="tipo_papel" class="block text-sm font-medium text-gray-700">Tipo de Papel</label>
                <input type="text" name="tipo_papel" id="tipo_papel" value="{{ old('tipo_papel') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="gramatura" class="block text-sm font-medium text-gray-700">Gramatura</label>
                <input type="number" name="gramatura" id="gramatura" value="{{ old('gramatura') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="cores" class="block text-sm font-medium text-gray-700">Cores</label>
                <input type="text" name="cores" id="cores" value="{{ old('cores') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="acabamento" class="block text-sm font-medium text-gray-700">Acabamento</label>
                <input type="text" name="acabamento" id="acabamento" value="{{ old('acabamento') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Imagem</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <button type="submit"
                class="inline-flex justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                Cadastrar
            </button>
        </form>
    </div>
@endsection
