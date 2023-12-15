<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Essa function irá receber via post o email e senha do user que está tentando fazer a autenticação
    public function auth(Request $request){
        // o array vai receber as credenciais p/ autenticar/logar e já vai fazer as validações
        $credenciais = $request->validate([
            // os campos são de preencimento obrigatorio e o email, precisa ser um email válido, por isso o seg. parametro
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            // Personaliza o erro que será exibido no blade login de acordo c/ a validação[nomeCampo.TipoValidação => msg personalizada]
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O email não é válido',
            'password.required' => 'O campo senha é obrigatório',
        ]);

            // o ATTEMPT irá verificar se existe um user cadastrado com essas credenciais no bd. e ver se o campo remember do formulário é true(cheackbox)
            // $request->remember : manterá o usuário autenticado indefinidamente ou até que ele efetue logout manualmente.
        if (Auth::attempt($credenciais, $request->remember)) {
            // se o user existir, uma nova session será criada
            $request->session()->regenerate();
            // redireciona o user p/ a URL que ele estava tentando acessar antes de ser captuado pelo filtro de autenticação.
            return redirect()->intended(route('admin.dashboard'));

        }else{
            // se não tiver atenticado irá retornar p/ page anterior 
            return redirect()->back()->with('erro', 'Email ou senha inválida.');
        }
    }
    // Função responsavel por fazer o logout
    public function logout(Request $request){
        Auth::logout();
        // Após deslogar é preciso invalidar a sessão, gerar um novo token e redirecionar p/ rota index 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Ao usar o redirect é preciso informar o path da rota, ou add um route(nomeRota)
        return redirect(route('site.index'));

    }

    public function create(){
        return view('login.create');
    }
}
