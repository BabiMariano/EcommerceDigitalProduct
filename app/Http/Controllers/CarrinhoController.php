<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    // 
    public function carrinhoLista(){
        // Return o conteudo do carrinho 
        $itens = \Cart::getContent();
        return view('site.carrinho', compact('itens'));
    }

    // como os dados serão enviados via post, é preciso de uma instancia da requisição http($request), p/ pegar os dados enviados
    public function adicionaCarrinho(Request $request){
        // add o produto ao carrinho, passar um array com as info do produto que será add. as chaves do array são padrão 
        // e pertencem a biblioteca cart
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            // O abs faz com que o campo só possa receber valores absolutos(desconsidera o sinal)
            'quantity' => abs($request->qnt),
            'attributes' => array(
                'image' => $request->img,
            )
            ]);
        
        // Quando o produto for add ao carinho, irá redirecionar p/ rota carrinho
        // O with('tipo da msg','mensagem')-> irá retornar uma mensagem se o produto for add no carrinho
        return redirect()->route('site.carrinho')->with('sucesso', 'Produto adicionado no carrinho com sucesso!');

    }
    // excluir itens do carrinho pelo id
    public function removeCarrinho(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('site.carrinho')->with('sucesso', 'Produto removido do carrinho com sucesso!');
    }

    public function atualizaCarrinho(Request $request){
        // é passado um array c/ os atributos que deseja atualizar, por padrão a atualização recebe um RELATIVE com o valor atual da qnt de itens,
        // mudar esse valor p/ false p/ que a qnt possa ser atualizada c/ a nova qnt de itens 
        \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => abs($request->quantity),
            ],
        ]);
        return redirect()->route('site.carrinho')->with('sucesso', 'Produto atualizado com sucesso!');
    }

    // Responsavel por limpar o carrinho
    public function limparCarrinho(){
        \Cart::clear();
        return redirect()->route('site.carrinho')->with('aviso', 'Seu carrinho está vazio!');
    }


}
