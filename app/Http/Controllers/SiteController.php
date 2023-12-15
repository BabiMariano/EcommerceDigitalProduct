<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Produto;
use Database\Factories\ProdutoFactory;
use Illuminate\Support\Facades\Gate;

class SiteController extends Controller
{
    //
    public function index()
    {
        //return 'index';
        // Return 3 produtos por página
        $produtos = Produto::paginate(3);

        return view('site.home', compact('produtos'));
        
    }

    public function details($slug)
    {
        // Return detalhes do produtos, o first() serve p/ trazer apenas 1 registro, diferente do all()
        $produto = Produto::where('slug', $slug)->first();

        // // a view só será retornada se o user que que está auth for o mesmo que castrou o produto
        // Gate::authorize('ver-produto', $produto);

        // chamando o policy ao invés do gate(nome da função do Policy, model relacionado)
        // $this->authorize('verProduto', $produto);

        // permite o acesso, se o user que cadrastrou o produto for o mesmo que está tentando acessa-lá, USA OS GATES
        if(Gate::allows('ver-produto', $produto)){
            return view('site.details', compact('produto'));
        }

        // faz a negação, se o user que está tentando acessar a view for != do user que cadastrou o produto, ele será redirect p/ index USA OS GATES
        if (Gate::denies('ver-produto', $produto)) {
            return redirect()->route('site.index');
        }

        // // permite o acesso, se o user que cadrastrou o produto for o mesmo que está tentando acessa-lá, USA OS POLICY
        // if(auth()->user()->can('verProduto', $produto)){
        //     return view('site.details', compact('produto'));
        // }

        // // faz a negação, se o user que está tentando acessar a view for != do user que cadastrou o produto, ele será redirect p/ index USA OS POLICY
        // if (auth()->user()->cannot('verProduto', $produto)) {
        //     return redirect()->route('site.index');
        // }
        
        
    }

    public function categoria($id)
    {
        // Encontra as info relacionadas a categoria, procurando a categ. pelo id 
        $categoria = Categoria::find($id);

        // Return os produtos de acordo com as categorias. só irá lista os produtos que o id passado no param, for = ao id_categorias
        // Quando se usa condição não dá pra usar o all, então use o get()/paginate(2)
        $produtos = Produto::where('id_categoria', $id)->paginate(3);

        return view('site.categoria', compact('produtos', 'categoria'));
    }
}
