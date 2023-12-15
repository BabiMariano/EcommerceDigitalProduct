@if ($mensagem = Session::get('erro'))
    {{ $mensagem }};
@endif

{{-- Se existir algum erro ao tentar logar, será retornado a mensagem c/ o tipo do erro --}}
@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach
@endif

<form action="{{ route('login.auth') }}" method="POST">
    @csrf
    Email <br> <input type="email" name="email"> <br>
    Senha <br> <input type="password" name="password"> <br>
    {{-- o remember passa a ser true se o checkbox for selecionado. o valor é recuperado no Cont.Login--}}
    <input type="checkbox" name="remember" > Lembrar-me
<button type="submit">Entrar</button>


</form>