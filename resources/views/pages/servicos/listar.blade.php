
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Lista de Serviços</h2>
        <a href="{{ route('servicos.cadastrar') }}"
   class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 transition">
   + Cadastrar Novo Serviço
</a>


        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($servicos->isEmpty())
            <p class="text-gray-600">Nenhum Serviço cadastrado ainda.</p>

        @else
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-md">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Descrição</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Preço</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Prazo</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Tipo</th>
                        <th class="px-4 py-2 text-sm text-gray-500">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($servicos as $servico)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $servico->nome }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $servico->descricao }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{number_format($servico->preco,2) }} kzs</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $servico->prazo_estimado }} dia(s)</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $servico->tipo }}</td>
                            <td class="px-4 py-2 space-x-2 text-sm">
                                <a href="{{route('servicos.editar', $servico->id)}}"
                                   class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                <form action="{{route('servicos.excluir',$servico->id)}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $servicos->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

