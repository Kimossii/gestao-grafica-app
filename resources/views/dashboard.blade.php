@extends('layouts.app')

@section('content')
<style>
    /* Centralizar e espaçar a div */
    .welcome-container {
        margin: 3rem 10px 0; /* margem topo menor que 5rem, 10px laterais */
        display: flex;
        justify-content: center; /* centraliza horizontal */
    }
    .alert {
        max-width: 600px; /* limitar largura máxima */
        width: 100%;
        box-shadow: 0 0 10px rgba(72, 180, 97, 0.5);
        border-radius: 0.5rem;
        font-size: 1.25rem;
    }
    .alert-text {
        margin-left: 1rem; /* espaçamento entre ícone e texto */
        font-size: 1.25rem; /* tamanho do texto */
    }
</style>

<div class="welcome-container">
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-3" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" role="img" aria-label="Success:">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.439 6.03 7.97a.75.75 0 1 0-1.06 1.06l1.5 1.5z"/>
        </svg>
        <div class="alert-text">
            <strong>Olá, {{ Auth::user()->name }}!</strong><br>
            Seja bem-vindo(a) ao sistema de gestão da gráfica. Agora você está autenticado com sucesso.
        </div>
    </div>
</div>
@endsection
