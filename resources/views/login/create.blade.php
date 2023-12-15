
{{-- Se existir algum erro ao tentar logar, será retornado a mensagem c/ o tipo do erro --}}
@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
@endif

{{-- Quando o form for enviado a rota users será ativada e será chamado controller users.store p/ receber os dados e armazenar no banco de dados --}}
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    Nome: <br> <input type="text" name="firstName"> <br>
    Sobrenome: <br> <input type="text" name="lastName"> <br>
    Email: <br> <input type="email" name="email"> <br>
    Senha: <br> <input type="password" name="password"> <br>
    
    <button type="submit">Cadastrar</button>


</form>