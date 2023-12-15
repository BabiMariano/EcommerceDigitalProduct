@extends('site.layout')
@section('title', 'Page Carrinho')
@section('conteudo')
   

<div class="row container">
    {{-- Se o tipo da mensagem que foi passada no controller carrinho for = sucesso, a mensagem será exibida --}}
    @if ($msg = Session::get('sucesso'))

        <div class="card #00c853 green accent-4">
            <div class="card-content white-text">
                <span class="card-title">OK</span>
                <p>{{ $msg }}</p>
            </div>
        </div>
        
    @endif

    @if ($msg = Session::get('aviso'))

        <div class="card #1565c0 blue darken-3">
            <div class="card-content white-text">
                <span class="card-title">OK</span>
                <p>{{ $msg }}</p>
            </div>
        </div>
        
    @endif

    @if ($itens->count() == 0)
        <div class="card #1565c0 blue darken-3">
            <div class="card-content white-text">
                <span class="card-title">Seu carrinho está vazio!</span>
                <p>Aproveite as promoções</p>
            </div>
        </div>
    @else
        <h5>Seu carrinho possui {{ $itens->count() }} produtos</h5>

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($itens as $item)
                    <tr>
                        <td><img src="{{ $item->attributes->image }}" alt="" width="70" class="responsive-img circle"></td>
                        <td>{{ $item->name }}</td>
                        <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>

                        {{-- Ao clicar no button refresh, a rota atualizaCarrinho é acionada, e ativa o controller atualizaCarrinho  --}}
                        <form action="{{ route('site.atualizaCarrinho') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <td><input style="width: 40px; font-weight: 600;" class="white center" type="number" min="1" name="quantity" value="{{ $item->quantity }}"></td>
                        <td>
                            <button class="btn-floating waves-effect waves-light #e91e63 pink "><i class="material-icons">refresh</i></button>
                        </form>
                        
                            {{-- Ao clicar no button delete, a rota removeCarrinho é acionada, e ativa o controller removeCarrinho  --}}
                            <form action="{{ route('site.removeCarrinho') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button class="btn-floating waves-effect waves-light #f06292 pink lighten-2 "><i class="material-icons">delete</i></button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach  

            </tbody>
        </table>

        
        <div class="card #880e4f pink darken-4">
            <div class="card-content white-text">
                {{-- Exibindo o valor total dos produtos add no carrinho --}}
                <span class="card-title" style="font-weight: 500;">TOTAL: R$ {{ number_format(\Cart::getTotal(2, ',', '.')) }}</span>
                <p>Pague em 12x sem juros</p>
            </div>
        </div>
    @endif
    
    <div class="row container center">
        <a href="{{ route('site.index') }}" class="btn waves-effect waves-light #1565c0 blue darken-3"> Continuar comprando <i class="material-icons right">arrow_back</i></a>
        <a href="{{ route('site.limparCarrinho') }}" class="btn waves-effect waves-light #1565c0 blue darken-3"> Limpar carrinho <i class="material-icons right">clear</i></a>
        <button class="btn waves-effect waves-light #00c853 green accent-4"> Finalizar pedido <i class="material-icons right">check</i></button>

    </div>
   
    
</div>

    
@endsection



