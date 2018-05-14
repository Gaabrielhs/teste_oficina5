<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contatos;
use App\User;


class UserController extends Controller
{
    private $userModel;
    private $contatosModel;

    public function __construct(User $user, Contatos $contatos)
    {
        $this->userModel = $user;
        $this->contatosModel = $contatos;
    }

    public function index()
    {
        /*dd($this->contatosModel->all());*/

        $usuario = Auth::user();
        return view('home', ['contatos' => $usuario->contatos]);
    }

    public function profile(){
        return view('profile', ['user' => Auth::user()]);
    }
}
