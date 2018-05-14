<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contatos;
use App\User;

class HomeController extends Controller
{
    private $userModel;
    private $contatosModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Contatos $contatos)
    {
        $this->middleware('auth');
        $this->userModel = $user;
        $this->contatosModel = $contatos;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*dd($this->contatosModel->all());*/

        $usuario = Auth::user();
        return view('home', ['contatos' => $usuario->contatos]);
    }
}
