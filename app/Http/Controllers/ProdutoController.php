<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    //
    public function listar()
    {
        $produtos = Produto::paginate(10);
        return view('pages.produtos.listar', compact('produtos'));
    }
    public function cadastrar()
    {
        $categorias = Categoria::all();
        return view('pages.produtos.cadastrar', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|integer',
            'preco_base' => 'nullable|numeric|',
            'largura' => 'nullable|numeric|',
            'altura' => 'nullable|numeric|',
            'quantidade_minima' => 'nullable|integer',
            'prezo_producao' => 'nullable|numeric',
            'tipo_papel' => 'required|string|max:255',
            'gramatura' => 'nullable|integer',
            'cores' => 'required|string|max:255',
            'acabamento' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'prazo_producao' => 'nullable|integer',

        ]);

        // Tratamento da imagem
        $caminhoCapa = 'images/upload/capas/produtos/';
        $imageName = null;

        if ($request->hasFile('image')) {
            // Gerar um nome único para a imagem
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            // Salvar diretamente no diretório 'public/images/upload/banners/'
            $request->file('image')->move(public_path($caminhoCapa), $imageName);
        }
        // O caminho completo da imagem pode ser construído para salvar no banco de dados
        $imageName = $caminhoCapa . $imageName;

        // Criação do Fornecedor
        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'categoria_id' => $request->categoria_id,
            'preco_base' => $request->preco_base,
            'largura' => $request->largura,
            'altura' => $request->altura,
            'quantidade_minima' => $request->quantidade_minima,
            'prezo_producao' => $request->prezo_producao,
            'tipo_papel' => $request->tipo_papel,
            'gramatura' => $request->gramatura,
            'cores' => $request->cores,
            'acabamento' => $request->acabamento,
            'image' => $imageName,
            'prazo_producao' => $request->prazo_producao,
        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('produtos.cadastrar')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function cadastrarCategoria()
    {
        return view('pages.produtos.categorias.cadastrar');
    }

    public function storeCategoria(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',

        ]);

        // Criação do Fornecedor
        Categoria::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'status' => $request->status,

        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('categorias.cadastrar')->with('success', 'Categoria cadastrado com sucesso!');

    }

    public function editar($id){
        $produto = Produto::findOrFail($id);
         $categorias = Categoria::all();
        return view('pages.produtos.editar',compact('produto','categorias'));
    }
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'nullable|string|max:255',
            'descricao' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|integer',
            'preco_base' => 'nullable|numeric',
            'largura' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'quantidade_minima' => 'nullable|integer',
            'prezo_producao' => 'nullable|numeric',
            'tipo_papel' => 'required|string|max:255',
            'gramatura' => 'nullable|integer',
            'cores' => 'required|string|max:255',
            'acabamento' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'prazo_producao' => 'nullable|integer',
        ]);

        $produto = Produto::findOrFail($id);

        // Trata imagem
        $caminhoCapa = 'images/upload/capas/produtos/';
        $imageName = $produto->image;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path($caminhoCapa), $imageName);
            $imageName = $caminhoCapa . $imageName;
        }

        $produto->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'categoria_id' => $request->categoria_id,
            'preco_base' => $request->preco_base,
            'largura' => $request->largura,
            'altura' => $request->altura,
            'quantidade_minima' => $request->quantidade_minima,
            'prezo_producao' => $request->prezo_producao,
            'tipo_papel' => $request->tipo_papel,
            'gramatura' => $request->gramatura,
            'cores' => $request->cores,
            'acabamento' => $request->acabamento,
            'image' => $imageName,
            'prazo_producao' => $request->prazo_producao,
        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('produtos.editar', $id)->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produtos.listar')->with('success', 'Produto excluído com sucesso!');
    }
}
