@extends('site.layout')
@section('title', 'Page Categorias')
@section('conteudo')
   

<div class="row container">
    <h5>Categoria: {{ $categoria->name }}</h5>
    @foreach ($produtos as $produto)

        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="{{ $produto->imagem }}">
                    {{-- Ao clicar no link, a rota passa a ser (caminho do arq. da page de mais info do produto, e o slug que identifica o produto) --}}
                    <a href="{{ route('site.details', $produto->slug) }}" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">visibility</i></a>
                </div>
                <div class="card-content">
                    <span class="card-title">{{ Str::limit( $produto->nome, 15) }}</span>
                    <p>{{Str::limit($produto->descricao, 40)  }}</p> 
                    
                </div>
            </div>
        </div>

    @endforeach
    
</div>

<div class="row center">
    {{-- chamando o arq. de customização da pagination --}}
    {{ $produtos->links('custom.pagination') }}
</div>
    
@endsection



