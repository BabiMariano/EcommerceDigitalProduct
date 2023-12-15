@extends('site.layout')
@section('title', 'Detalhes')
@section('conteudo')

<div class="row container">
    <div class="col s12 m6">
        <img src="{{ $produto->imagem }}" class="responsive-img">
    </div>

    <div class="col s12 m6">
        <h4>{{ $produto->nome }}</h4>
        {{-- Formatando preço, com 2 casas decimais, separador de decimal c/ virgula e separador de milhar c/ ponto --}}
        <h4> R$ {{ number_format($produto->preco, 2, ',', '.') }}</h4>
        <p>{{ $produto->descricao }}</p>
        {{-- Puxando info do model produto --}}
        <p> Postado por: {{ $produto->user->firstName }} <br>
            Categoria: {{ $produto->categoria->nome }}
        </p>

        {{-- ao clicar em comprar as info do produto serão passadas p/ os campos do form e o metodo addCarinho recebe essas info --}}
        <form action="{{ route('site.addCarrinho') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $produto->id }}">
            <input type="hidden" name="name" value="{{ $produto->nome }}">
            <input type="hidden" name="price" value="{{ $produto->preco }}">
            <input type="number" min="1" name="qnt" value="1">
            <input type="hidden" name="img" value="{{ $produto->imagem }}">
            <button class="btn #e91e63 pink btn-large"> Comprar </button>
        </form>

    </div>

</div>

@endsection
