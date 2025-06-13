@extends('layouts.app')
@section('title', 'Lista de Clientes')
@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Lista de Clientes</h2>
        <a href="{{ route('clientes.cadastrar') }}"
   class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 transition">
   + Cadastrar Novo Cliente
</a>


        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($clientes->isEmpty())
            <p class="text-gray-600">Nenhum cliente cadastrado ainda.</p>

        @else
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-md">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">E-mail</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Telefone</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">NIF</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Endereço</th>
                        <th class="px-4 py-2 text-sm text-gray-500">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $cliente->nome }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $cliente->email }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $cliente->telefone }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $cliente->nif }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $cliente->endereco }}</td>
                            <td class="px-4 py-2 space-x-2 text-sm">
                                <a href="{{route('clientes.editar', $cliente->id)}}"
                                   class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                <form action="{{route('clientes.excluir',$cliente->id)}}" method="POST" class="inline">
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
                {{ $clientes->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

