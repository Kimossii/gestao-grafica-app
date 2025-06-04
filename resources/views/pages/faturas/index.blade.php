@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ações de Fatura</h2>
        <div class="flex flex-col sm:flex-row gap-6 flex-wrap">
            <a href="{{route('faturas.fatura.cadastrar')}}"
               class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow p-8 flex flex-col items-center transition">
                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-xl font-semibold">Nova Fatura</span>
            </a>
            <a href="{{route('faturas.faturarecibo.cadastrar')}}"
               class="flex-1 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow p-8 flex flex-col items-center transition">
                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2v-7a2 2 0 00-2-2z"/>
                </svg>
                <span class="text-xl font-semibold">Fatura Recibo</span>
            </a>
            <a href="{{route('faturas.fatura.listar')}}"
               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow p-8 flex flex-col items-center transition">
                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
                <span class="text-xl font-semibold">Listar Faturas</span>
            </a>
            <a href="{{route('faturas.faturarecibo.listar')}}"
               class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg shadow p-8 flex flex-col items-center transition">
                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-10 4h6m2 5H7a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-xl font-semibold">Listar Fatura Recibo</span>
            </a>
        </div>
    </div>
</div>
@endsection
