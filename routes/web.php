<?php

use App\Http\Controllers\ProfileController, App\Http\Controllers\ClienteController,
App\Http\Controllers\FornecedorController, App\Http\Controllers\FaturaController,
App\Http\Controllers\ProdutoController, App\Http\Controllers\ServicoController,
App\Http\Controllers\UsuarioController, App\Http\Controllers\FluxoCaixaController,
App\Http\Controllers\ContaReceberController, App\Http\Controllers\ContaPagarController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {

    //Clientes
    Route::prefix('/clientes')->group(function () {
        Route::get('/cadastrar', [ClienteController::class, 'cadastrar'])->name('clientes.cadastrar');
        Route::post('/cadastrar', [ClienteController::class, 'store'])->name('clientes.store');
        Route::get('/listar', [ClienteController::class, 'listar'])->name('clientes.listar');
        Route::get('/editar/{id}', [ClienteController::class, 'editar'])->name('clientes.editar');
        Route::put('/editar/{id}', [ClienteController::class, 'update'])->name('clientes.update');
        Route::delete('/excluir/{id}', [ClienteController::class, 'destroy'])->name('clientes.excluir');
    });
    //Fornecedores
    Route::prefix('/fornecedores')->group(function () {
        Route::get('/cadastrar', [FornecedorController::class, 'cadastrar'])->name('fornecedores.cadastrar');
        Route::get('/listar', [FornecedorController::class, 'listar'])->name('fornecedores.listar');
        Route::post('/store', [FornecedorController::class, 'store'])->name('fornecedores.store');
        Route::get('/editar/{id}', [FornecedorController::class, 'editar'])->name('fornecedores.editar');
        Route::put('/update/{id}', [FornecedorController::class, 'update'])->name('fornecedores.update');
        Route::delete('/excluir/{id}', [FornecedorController::class, 'destroy'])->name('fornecedores.excluir');
    });
    //Serviços
    Route::prefix('/servicos')->group(function () {
        Route::get('/cadastrar', [ServicoController::class, 'cadastrar'])->name('servicos.cadastrar');
        Route::get('/listar', [ServicoController::class, 'listar'])->name('servicos.listar');
        Route::post('/store', [ServicoController::class, 'store'])->name('servicos.store');
        Route::get('/editar/{id}', [ServicoController::class, 'editar'])->name('servicos.editar');
        Route::put('/update/{id}', [ServicoController::class, 'update'])->name('servicos.update');
        Route::delete('/excluir/{id}', [ServicoController::class, 'destroy'])->name('servicos.excluir');
    });

    //Produtos $ Categoria

    //categoria
    Route::prefix('/categorias')->group(function () {
        Route::get('/listar', [ProdutoController::class, 'listarCategoria'])->name('categorias.listar');
        Route::get('/cadastrar', [ProdutoController::class, 'cadastrarCategoria'])->name('categorias.cadastrar');
        Route::post('/store', [ProdutoController::class, 'storeCategoria'])->name('categorias.store');
    });
    //Produtos
    Route::prefix('/produtos')->group(function () {
        Route::get('/listar', [ProdutoController::class, 'listar'])->name('produtos.listar');
        Route::get('/cadastrar', [ProdutoController::class, 'cadastrar'])->name('produtos.cadastrar');
        Route::put('/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
        Route::post('/store', [ProdutoController::class, 'store'])->name('produtos.store');
        Route::get('/editar/{id}', [ProdutoController::class, 'editar'])->name('produtos.editar');
        Route::delete('/excluir/{id}', [ProdutoController::class, 'destroy'])->name('produtos.excluir');
    });

    Route::prefix('/faturas')->group(function () {
        Route::get('/index', [FaturaController::class, 'index'])->name('faturas.index');

        //Faturas
        Route::get('/fatura', [FaturaController::class, 'faturaCadastrar'])->name('faturas.fatura.cadastrar');
        Route::post('/store', [FaturaController::class, 'faturaStore'])->name('faturas.fatura.store');
        Route::get('/fatura/listar', [FaturaController::class, 'faturaListar'])->name('faturas.fatura.listar');
        Route::get('/fatura/detalhe/{id}', [FaturaController::class, 'faturaDetalhe'])->name('faturas.fatura.detalhe');
        Route::get('/{fatura}/pdf', [FaturaController::class, 'gerarFatura'])->name('faturas.fatura.pdf');

        //Fatura Recibo
        Route::get('/fatura-recibo/cadastrar', [FaturaController::class, 'faturaReciboCadastrar'])->name('faturas.faturarecibo.cadastrar');
        Route::post('/fatura/recibo/store', [FaturaController::class, 'faturaReciboStore'])->name('faturas.faturarecibo.store');
        Route::get('/fatura-recibo/listar', [FaturaController::class, 'faturaReciboListar'])->name('faturas.faturarecibo.listar');
        Route::get('/fatura-recibo/detalhe/{id}', [FaturaController::class, 'faturaReciboDetalhe'])->name('faturas.faturarecibo.detalhe');
        Route::get('/fatura-recibo/{fatura}/pdf', [FaturaController::class, 'gerarFaturarecibo'])->name('faturas.faturarecibo.pdf');

        //Recibos
        Route::get('/recibo/listar', [FaturaController::class, 'reciboListar'])->name('faturas.recibo.listar');
        Route::get('/recibo/detalhe/{id}', [FaturaController::class, 'reciboDetalhe'])->name('faturas.recibo.detalhe');
        Route::get('/recibo/pagar/{id}', [FaturaController::class, 'reciboPagar'])->name('faturas.recibo.pagar');
        Route::post('/recibo/store/{id}', [FaturaController::class, 'reciboStore'])->name('faturas.recibo.store');
    });

    //Contas a Receber
    Route::prefix('/contas-a-receber')->group(function () {
        Route::get('/contas-a-pagar', [ContaReceberController::class, 'indexContas'])->name('contas.index');
        Route::get('/cadastrar', [ContaReceberController::class, 'cadastrar'])->name('contas.cadastrar.receber');
        Route::post('/store', [ContaReceberController::class, 'store'])->name('contas.store.receber');
        Route::get('/listar', [ContaReceberController::class, 'index'])->name('contas.listar.receber');
        Route::get('/detalhe/{id}', [ContaReceberController::class, 'detalhe'])->name('contas.detalhe.receber');
        Route::get('/editar/{id}', [ContaReceberController::class, 'editar'])->name('contas.editar.receber');
        Route::put('/update/{id}', [ContaReceberController::class, 'update'])->name('contas.update.receber');
        Route::delete('/excluir/{id}', [ContaReceberController::class, 'destroy'])->name('contas.excluir.receber');
    });

    //Contas a Pagar
    Route::prefix('/contas-a-pagar')->group(function () {
        Route::get('/contas-a-receber', [ContaPagarController::class, 'index'])->name('contas.index.pagar');
        Route::get('/cadastrar', [ContaPagarController::class, 'cadastrar'])->name('contas.cadastrar.pagar');
        Route::post('/store', [ContaPagarController::class, 'store'])->name('contas.store.pagar');
        Route::get('/listar', [ContaPagarController::class, 'index'])->name('contas.listar.pagar');
        Route::get('/detalhe/{id}', [ContaPagarController::class, 'detalhe'])->name('contas.detalhe.pagar');
        Route::get('/editar/{id}', [ContaPagarController::class, 'editar'])->name('contas.editar.pagar');
        Route::put('/update/{id}', [ContaPagarController::class, 'update'])->name('contas.update.pagar');
        Route::delete('/excluir/{id}', [ContaPagarController::class, 'destroy'])->name('contas.excluir.pagar');
    });
    //Usuarios
    Route::prefix('/usuarios')->group(function () {
        Route::get('/cadastrar', [UsuarioController::class, 'cadastrar'])->name('usuarios.cadastrar');
        Route::get('/listar', [UsuarioController::class, 'index'])->name('usuarios.listar');
        Route::post('/store', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/editar/{id}', [UsuarioController::class, 'editar'])->name('usuarios.editar');
        Route::put('/update/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/excluir/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.excluir');
    });

    //Fluxo de Caixa
    Route::get('/fluxo-caixa/index', [FluxoCaixaController::class, 'index'])->name('fluxo.index');

});


require __DIR__ . '/auth.php';
