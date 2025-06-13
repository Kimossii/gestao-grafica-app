@extends('layouts.app')
@section('title', 'Fluxo de Caixa')
@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Relatórios de Faturas</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

            <!-- Card Diário -->
            <div class="bg-blue-600 text-white rounded-2xl shadow-lg p-6 flex flex-col items-center justify-center">
                <span class="text-lg font-medium">Diário</span>
                <span class="text-xl font-bold mt-2">{{ number_format($totais['diario'], 2, ',', '.') }} Kz</span>
            </div>

            <!-- Card Semanal -->
            <div class="bg-green-600 text-white rounded-2xl shadow-lg p-6 flex flex-col items-center justify-center">
                <span class="text-lg font-medium">Semanal</span>
                <span class="text-xl font-bold mt-2">{{ number_format($totais['semanal'], 2, ',', '.') }} Kz</span>
            </div>

            <!-- Card Mensal -->
            <div class="bg-indigo-600 text-white rounded-2xl shadow-lg p-6 flex flex-col items-center justify-center">
                <span class="text-lg font-medium">Mensal</span>
                <span class="text-xl font-bold mt-2">{{ number_format($totais['mensal'], 2, ',', '.') }} Kz</span>
            </div>

            <!-- Card Trimestral -->
            <div class="bg-yellow-500 text-white rounded-2xl shadow-lg p-6 flex flex-col items-center justify-center">
                <span class="text-lg font-medium">Trimestral</span>
                <span class="text-xl font-bold mt-2">{{ number_format($totais['trimestral'], 2, ',', '.') }} Kz</span>
            </div>

            <!-- Card Anual -->
            <div class="bg-red-600 text-white rounded-2xl shadow-lg p-6 flex flex-col items-center justify-center">
                <span class="text-lg font-medium">Anual</span>
                <span class="text-xl font-bold mt-2">{{ number_format($totais['anual'], 2, ',', '.') }} Kz</span>
            </div>

        </div>
    </div>
</div>
@endsection
