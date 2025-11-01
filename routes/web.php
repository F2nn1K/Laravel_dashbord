<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\InvestidorController;
use App\Http\Controllers\admin\AsociadoController;
use App\Http\Controllers\admin\OutroController;
use App\Http\Controllers\admin\UsuarioController;
use App\Http\Controllers\admin\EmpresaController;
use App\Http\Controllers\admin\FuncionarioController;
use App\Http\Controllers\admin\ProdutoController;
use App\Http\Controllers\admin\RelatorioController;
use App\Http\Controllers\admin\AbrirEncerrarVendaController;
use App\Http\Controllers\admin\VendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComunController;

// Redirecionar todas as rotas raiz para /login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
})->name('login');

Route::get('/cadastro', function () {return view('auth.register');})->name('cadastro');

Route::post('/logon', [AuthController::class, 'logon'])->name('logon');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth', 'prevent.back'])->group(function () {

// Logout - aceitar tanto GET quanto POST
Route::match(['get', 'post'], '/logout', function () {
    // Limpar completamente a sessão
    Auth::guard('web')->logout();
    
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    request()->session()->flush();
    
    // Redirecionar com headers para prevenir cache
    return redirect('/login')
        ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
})->name('logout');

Route::get('/profile', [ComunController::class, 'profile'])->name('profile');
Route::get('/settings', [ComunController::class, 'settings'])->name('settings');

Route::get('/dashboard', [ComunController::class, 'dashboard'])->name('dashboard');

Route::get('/configuracoes', function () {
    return view('configuracoes.index', [
        'pageTitle' => 'Configurações do Sistema'
    ]);
})->name('configuracoes');

Route::prefix('asociado')->group(function () {
    Route::get('/all', [AsociadoController::class, 'all'])->name('asociado.all');
    Route::get('/', [AsociadoController::class, 'index'])->name('asociado');
    Route::get('/search', [AsociadoController::class, 'search'])->name('asociado.search');
    Route::post('/add', [AsociadoController::class, 'add'])->name('asociado.add');
    Route::get('/edt/id/{id}', [AsociadoController::class, 'edt'])->name('asociado.edt');
    Route::post('/upd/id/{id}', [AsociadoController::class, 'upd'])->name('asociado.upd');
    Route::get('/show/id/{id}', [AsociadoController::class, 'show'])->name('asociado.show');
    Route::get('/del/id/{id}', [AsociadoController::class, 'del'])->name('asociado.del');
});

Route::prefix('investidor')->group(function () {
    Route::get('/all', [InvestidorController::class, 'all'])->name('investidor.all');
    Route::get('/', [InvestidorController::class, 'index'])->name('investidor');
    Route::get('/search', [InvestidorController::class, 'search'])->name('investidor.search');
    Route::post('/add', [InvestidorController::class, 'add'])->name('investidor.add');
    Route::get('/edt/id/{id}', [InvestidorController::class, 'edt'])->name('investidor.edt');
    Route::post('/upd/id/{id}', [InvestidorController::class, 'upd'])->name('investidor.upd');
    Route::get('/show/id/{id}', [InvestidorController::class, 'show'])->name('investidor.show');
    Route::get('/del/id/{id}', [InvestidorController::class, 'del'])->name('investidor.del');
});

Route::prefix('outro')->group(function () {
    Route::get('/all', [OutroController::class, 'all'])->name('outro.all');
    Route::get('/', [OutroController::class, 'index'])->name('outro');
    Route::get('/search', [OutroController::class, 'search'])->name('outro.search');
    Route::post('/add', [OutroController::class, 'add'])->name('outro.add');
    Route::get('/edt/id/{id}', [OutroController::class, 'edt'])->name('outro.edt');
    Route::post('/upd/id/{id}', [OutroController::class, 'upd'])->name('outro.upd');
    Route::get('/show/id/{id}', [OutroController::class, 'show'])->name('outro.show');
    Route::get('/del/id/{id}', [OutroController::class, 'del'])->name('outro.del');
});

Route::prefix('usuario')->group(function () {
    Route::get('/all', [UsuarioController::class, 'all'])->name('usuario.all');
    Route::get('/', [UsuarioController::class, 'index'])->name('usuario');
    Route::get('/search', [UsuarioController::class, 'search'])->name('usuario.search');
    Route::post('/add', [UsuarioController::class, 'add'])->name('usuario.add');
    Route::get('/edt/id/{id}', [UsuarioController::class, 'edt'])->name('usuario.edt');
    Route::post('/upd/id/{id}', [UsuarioController::class, 'upd'])->name('usuario.upd');
    Route::get('/show/id/{id}', [UsuarioController::class, 'show'])->name('usuario.show');
    Route::get('/del/id/{id}', [UsuarioController::class, 'del'])->name('usuario.del');
});

Route::prefix('empresa')->group(function () {
    Route::get('/all', [EmpresaController::class, 'all'])->name('empresa.all');
    Route::get('/', [EmpresaController::class, 'index'])->name('empresa');
    Route::get('/search', [EmpresaController::class, 'search'])->name('empresa.search');
    Route::post('/add', [EmpresaController::class, 'add'])->name('empresa.add');
    Route::get('/edt/id/{id}', [EmpresaController::class, 'edt'])->name('empresa.edt');
    Route::post('/upd/id/{id}', [EmpresaController::class, 'upd'])->name('empresa.upd');
    Route::get('/show/id/{id}', [EmpresaController::class, 'show'])->name('empresa.show');
    Route::get('/del/id/{id}', [EmpresaController::class, 'del'])->name('empresa.del');
});

Route::prefix('funcionario')->group(function () {
    Route::get('/all', [FuncionarioController::class, 'all'])->name('funcionario.all');
    Route::get('/', [FuncionarioController::class, 'index'])->name('funcionario');
    Route::get('/search', [FuncionarioController::class, 'search'])->name('funcionario.search');
    Route::post('/add', [FuncionarioController::class, 'add'])->name('funcionario.add');
    Route::get('/edt/id/{id}', [FuncionarioController::class, 'edt'])->name('funcionario.edt');
    Route::post('/upd/id/{id}', [FuncionarioController::class, 'upd'])->name('funcionario.upd');
    Route::get('/show/id/{id}', [FuncionarioController::class, 'show'])->name('funcionario.show');
    Route::get('/del/id/{id}', [FuncionarioController::class, 'del'])->name('funcionario.del');
});

Route::prefix('produto')->group(function () {
    Route::get('/all', [ProdutoController::class, 'all'])->name('produto.all');
    Route::get('/', [ProdutoController::class, 'index'])->name('produto');
    Route::get('/search', [ProdutoController::class, 'search'])->name('produto.search');
    Route::post('/add', [ProdutoController::class, 'add'])->name('produto.add');
    Route::get('/edt/id/{id}', [ProdutoController::class, 'edt'])->name('produto.edt');
    Route::post('/upd/id/{id}', [ProdutoController::class, 'upd'])->name('produto.upd');
    Route::get('/show/id/{id}', [ProdutoController::class, 'show'])->name('produto.show');
    Route::get('/del/id/{id}', [ProdutoController::class, 'del'])->name('produto.del');
});

Route::prefix('venda')->group(function () {
    Route::get('/all', [VendaController::class, 'all'])->name('venda.all');
    Route::get('/', [VendaController::class, 'index'])->name('venda');
    Route::get('/search', [VendaController::class, 'search'])->name('venda.search');
    Route::post('/add', [VendaController::class, 'add'])->name('venda.add');
    Route::get('/edt/id/{id}', [VendaController::class, 'edt'])->name('venda.edt');
    Route::post('/upd/id/{id}', [VendaController::class, 'upd'])->name('venda.upd');
    Route::get('/show/id/{id}', [VendaController::class, 'show'])->name('venda.show');
    Route::get('/del/id/{id}', [VendaController::class, 'del'])->name('venda.del');
});

Route::prefix('abrir-encerrar-venda')->group(function () {
    Route::get('/all', [AbrirEncerrarVendaController::class, 'all'])->name('abrir-encerrar-venda.all');
    Route::get('/', [AbrirEncerrarVendaController::class, 'index'])->name('abrir-encerrar-venda');
    Route::get('/search', [AbrirEncerrarVendaController::class, 'search'])->name('abrir-encerrar-venda.search');
    Route::post('/add', [AbrirEncerrarVendaController::class, 'add'])->name('abrir-encerrar-venda.add');
    Route::get('/edt/id/{id}', [AbrirEncerrarVendaController::class, 'edt'])->name('abrir-encerrar-venda.edt');
    Route::post('/upd/id/{id}', [AbrirEncerrarVendaController::class, 'upd'])->name('abrir-encerrar-venda.upd');
    Route::get('/show/id/{id}', [AbrirEncerrarVendaController::class, 'show'])->name('abrir-encerrar-venda.show');
    Route::get('/del/id/{id}', [AbrirEncerrarVendaController::class, 'del'])->name('abrir-encerrar-venda.del');
});

Route::prefix('relatorio')->group(function () {
Route::get('/', [RelatorioController::class, 'index'])->name('relatorio');
Route::get('/vendas', [RelatorioController::class, 'vendas'])->name('relatorio.vendas');
Route::get('/vendas/{inicio}/{fin}', [RelatorioController::class, 'vendasData'])
    ->name('relatorio.vendas-data');

Route::get('/venda', [RelatorioController::class, 'gerarRelatorioVenda'])->name('relatorio.venda');
Route::get('/cliente', [RelatorioController::class, 'relatorioGeralCliente'])->name('relatorio.geral-cliente');

// Modelo de Gestão
Route::get('/modelo-gestao', [RelatorioController::class, 'modeloGestao'])->name('relatorio.modelo-gestao');
Route::get('/modelo-gestao/gerar', [RelatorioController::class, 'gerarModeloGestao'])->name('relatorio.modelo-gestao.gerar');

// Modelo de Gestão 2 (com Assinatura)
Route::get('/modelo-gestao-2', [RelatorioController::class, 'modeloGestao2'])->name('relatorio.modelo-gestao-2');
Route::get('/modelo-gestao-2/gerar', [RelatorioController::class, 'gerarModeloGestao2'])->name('relatorio.modelo-gestao-2.gerar');

});

Route::get('/produto/{id}/preco', [ComunController::class, 'obterPrecoProduto']);

});