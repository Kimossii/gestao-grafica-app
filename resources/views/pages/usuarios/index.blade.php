@extends('layouts.app')
@section('title', 'Lista de Usuários')
@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Lista de Usuários</h2>
        <a href="{{ route('usuarios.cadastrar') }}"
           class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 transition">
           + Cadastrar Novo Usuário
        </a>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($usuarios->isEmpty())
            <p class="text-gray-600">Nenhum usuário cadastrado ainda.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-md">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">E-mail</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Perfil</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-sm text-gray-500">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $usuario->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $usuario->email }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $usuario->perfil }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                @if($usuario->status)
                                    <span class="text-green-600 font-semibold">Ativo</span>
                                @else
                                    <span class="text-red-600 font-semibold">Inativo</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2 text-sm">
                                <a href="{{ route('usuarios.editar', $usuario->id) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                <form action="{{route('usuarios.excluir',$usuario->id)}}" method="POST" class="inline">
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
                {{ $usuarios->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
