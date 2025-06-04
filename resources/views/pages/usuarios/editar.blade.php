@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Editar Usuário</h2>

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

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email <span
                        class="text-red-500">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="perfil" class="block text-sm font-medium text-gray-700">Perfil</label>
                <select name="perfil" id="perfil"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Selecione</option>
                    <option value="vendedor" {{ old('perfil', $usuario->perfil) == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                    <option value="admin" {{ old('perfil', $usuario->perfil) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div>
                <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $usuario->telefone) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Deixe em branco para não alterar">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="ativo" {{ old('status', $usuario->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                    <option value="inativo" {{ old('status', $usuario->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                Salvar
            </button>
        </form>
    </div>
@endsection
