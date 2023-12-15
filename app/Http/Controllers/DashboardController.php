<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
// use DB;


class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     // aplicar o middleware apenas aos methodos especificados
    //     // $this->middleware('auth')->only('index');
    //     // aplicar o middleware em tudo, exceto aos methodos especificados
    //     // $this->middleware('auth')->except('index');
    // }

    //
    public function index(): View {
        $usuarios = User::all()->count();

        $usersData = User::select([
            // irá retornar apenas o ano que a table foi criada
            DB::raw('YEAR(created_at) as ano'),

            // faz a contagem de usuarios de acordo com o ano de cada usuario 
            DB::raw('COUNT(*) as total'),
        ])
        ->groupBy('ano')
        ->orderBy('ano', 'asc')
        ->get();

        // preparar arrays
        foreach ($usersData as $user) {
            $ano[] = $user->ano;
            $total[] = $user->total;
        }

        // formatar p/ chart js
        $userLabel = "'Comparativo de cadrastros de usuários'";
        $userAno = implode(',', $ano);
        $userTotal = implode(',', $total);
        //  dd($usersData);

        $catData = Categoria::all();
        foreach ($catData as $cat) {
            $catNome[] = "'".$cat->nome."'";
            $catTotal[] = Produto::where('id_categoria', $cat->id)->count();
        }

        $catLabel = implode(',', $catNome);
        $catTotal = implode(',', $catTotal);
        // dd($catData);
       

        return view('admin.dashboard', compact('usuarios', 'userLabel', 'userAno', 'userTotal', 'catLabel', 'catTotal'));
    }
}
