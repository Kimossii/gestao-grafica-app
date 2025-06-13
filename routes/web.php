<?php

use App\Http\Controllers\ProfileController, App\Http\Controllers\ClienteController,
App\Http\Controllers\FornecedorController, App\Http\Controllers\FaturaController,
App\Http\Controllers\ProdutoController, App\Http\Controllers\ServicoController,
App\Http\Controllers\UsuarioController,App\Http\Controllers\FluxoCaixaController,
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
    Route::get('/clientes/cadastrar', [ClienteController::class, 'cadastrar'])->name('clientes.cadastrar');
    Route::post('/clientes/cadastrar', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/listar', [ClienteController::class, 'listar'])->name('clientes.listar');
    Route::get('/clientes/editar/{id}', [ClienteController::class, 'editar'])->name('clientes.editar');
    Route::put('/clientes/editar/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/excluir/{id}', [ClienteController::class, 'destroy'])->name('clientes.excluir');

    //Fornecedores
    Route::get('/fornecedores/cadastrar', [FornecedorController::class, 'cadastrar'])->name('fornecedores.cadastrar');
    Route::get('/fornecedores/listar', [FornecedorController::class, 'listar'])->name('fornecedores.listar');
    Route::post('/fornecedores/store', [FornecedorController::class, 'store'])->name('fornecedores.store');
    Route::get('/fornecedores/editar/{id}', [FornecedorController::class, 'editar'])->name('fornecedores.editar');
    Route::put('/fornecedores/update/{id}', [FornecedorController::class, 'update'])->name('fornecedores.update');
    Route::delete('/fornecedores/excluir/{id}', [FornecedorController::class, 'destroy'])->name('fornecedores.excluir');

    //Serviços
    Route::get('/servicos/listar', [ServicoController::class, 'listar'])->name('servicos.listar');
    Route::get('/servicos/cadastrar', [ServicoController::class, 'cadastrar'])->name('servicos.cadastrar');
    Route::put('/servicos/update/{id}', [ServicoController::class, 'update'])->name('servicos.update');
    Route::post('/servicos/store', [ServicoController::class, 'store'])->name('servicos.store');
    Route::get('/servicos/editar/{id}', [ServicoController::class, 'editar'])->name('servicos.editar');
    Route::delete('/servicos/excluir/{id}', [ServicoController::class, 'destroy'])->name('servicos.excluir');

    //Produtos $ Categoria

    //categoria
    Route::get('/categorias/listar', [ProdutoController::class, 'listarCategoria'])->name('categorias.listar');
    Route::get('/categorias/cadastrar', [ProdutoController::class, 'cadastrarCategoria'])->name('categorias.cadastrar');
    Route::post('/categorias/store', [ProdutoController::class, 'storeCategoria'])->name('categorias.store');

    Route::get('/produtos/listar', [ProdutoController::class, 'listar'])->name('produtos.listar');
    Route::get('/produtos/cadastrar', [ProdutoController::class, 'cadastrar'])->name('produtos.cadastrar');
    Route::put('/produtos/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::post('/produtos/store', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/editar/{id}', [ProdutoController::class, 'editar'])->name('produtos.editar');
    Route::delete('/produtos/excluir/{id}', [ProdutoController::class, 'destroy'])->name('produtos.excluir');

    //Fafturas
    Route::get('/faturas/index', [FaturaController::class, 'index'])->name('faturas.index');
    //Faturas
    Route::get('/faturas/fatura', [FaturaController::class, 'faturaCadastrar'])->name('faturas.fatura.cadastrar');
    Route::post('/faturas/store', [FaturaController::class, 'faturaStore'])->name('faturas.fatura.store');
    Route::get('/faturas/fatura/listar', [FaturaController::class, 'faturaListar'])->name('faturas.fatura.listar');
    Route::get('/faturas/fatura/detalhe/{id}', [FaturaController::class, 'faturaDetalhe'])->name('faturas.fatura.detalhe');
    Route::get('/faturas/{fatura}/pdf', [FaturaController::class, 'gerarFatura'])->name('faturas.fatura.pdf');

    //Fatura Recibo
    Route::get('/faturas/fatura-recibo/cadastrar', [FaturaController::class, 'faturaReciboCadastrar'])->name('faturas.faturarecibo.cadastrar');
    Route::post('/faturas/fatura/recibo/store', [FaturaController::class, 'faturaReciboStore'])->name('faturas.faturarecibo.store');
    Route::get('/faturas/fatura-recibo/listar', [FaturaController::class, 'faturaReciboListar'])->name('faturas.faturarecibo.listar');
    Route::get('/faturas/fatura-recibo/detalhe/{id}', [FaturaController::class, 'faturaReciboDetalhe'])->name('faturas.faturarecibo.detalhe');
    Route::get('/fatura-recibo/{fatura}/pdf', [FaturaController::class, 'gerarFaturarecibo'])->name('faturas.faturarecibo.pdf');

    //Recibos
    Route::get('/faturas/recibo/listar', [FaturaController::class, 'reciboListar'])->name('faturas.recibo.listar');
    Route::get('/faturas/recibo/detalhe/{id}', [FaturaController::class, 'reciboDetalhe'])->name('faturas.recibo.detalhe');
    Route::get('/faturas/recibo/pagar/{id}', [FaturaController::class, 'reciboPagar'])->name('faturas.recibo.pagar');
    Route::post('/faturas/recibo/store/{id}', [FaturaController::class, 'reciboStore'])->name('faturas.recibo.store');

    //Contas a Receber
    Route::get('/contas-a-receber/contas-a-pagar', [ContaReceberController::class, 'indexContas'])->name('contas.index');
    Route::get('/contas-a-receber/cadastrar', [ContaReceberController::class, 'cadastrar'])->name('contas.cadastrar.receber');
    Route::post('/contas-a-receber/store', [ContaReceberController::class, 'store'])->name('contas.store.receber');
    Route::get('/contas-a-receber/listar', [ContaReceberController::class, 'index'])->name('contas.listar.receber');
    Route::get('/contas-a-receber/detalhe/{id}', [ContaReceberController::class, 'detalhe'])->name('contas.detalhe.receber');
    Route::get('/contas-a-receber/editar/{id}', [ContaReceberController::class, 'editar'])->name('contas.editar.receber');
    Route::put('/contas-a-receber/update/{id}', [ContaReceberController::class, 'update'])->name('contas.update.receber');
    Route::delete('/contas-a-receber/excluir/{id}', [ContaReceberController::class, 'destroy'])->name('contas.excluir.receber');

    //Contas a Pagar
    Route::get('/contas-a-pagar/contas-a-receber', [ContaPagarController::class, 'index'])->name('contas.index.pagar');
    Route::get('/contas-a-pagar/cadastrar', [ContaPagarController::class, 'cadastrar'])->name('contas.cadastrar.pagar');
    Route::post('/contas-a-pagar/store', [ContaPagarController::class, 'store'])->name('contas.store.pagar');
    Route::get('/contas-a-pagar/listar', [ContaPagarController::class, 'index'])->name('contas.listar.pagar');
    Route::get('/contas-a-pagar/detalhe/{id}', [ContaPagarController::class, 'detalhe'])->name('contas.detalhe.pagar');
    Route::get('/contas-a-pagar/editar/{id}', [ContaPagarController::class, 'editar'])->name('contas.editar.pagar');
    Route::put('/contas-a-pagar/update/{id}', [ContaPagarController::class, 'update'])->name('contas.update.pagar');
    Route::delete('/contas-a-pagar/excluir/{id}', [ContaPagarController::class, 'destroy'])->name('contas.excluir.pagar');

    //Usuarios
    Route::get('/usurios/cadastrar', [UsuarioController::class, 'cadastrar'])->name('usuarios.cadastrar');
    Route::get('/usuarios/listar', [UsuarioController::class, 'index'])->name('usuarios.listar');
    Route::post('/usuarios/store', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->name('usuarios.editar');
    Route::put('/usuarios/update/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/excluir/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.excluir');

    //Fluxo de Caixa
    Route::get('/fluxo-caixa/index', [FluxoCaixaController::class, 'index'])->name('fluxo.index');

});


require __DIR__ . '/auth.php';
