<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditUser;
use App\Http\Requests\EditPassword;
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

    public function edit(EditUser $request){
        $data = $request->all();
        $user = Auth::user();
        $user->fill($data);
        if($user->save()){
            session(['status' => 'Perfil alterado com sucesso!']);
            return redirect()->route('home');
        }
    }

    public function password(){
        return view('password');
    }

    public function editPassword(EditPassword $request){
        $user = Auth::user();
        $user->password = Hash::make($request->input('password'));
        if($user->save()){
            session(['status' => 'Senha alterada com sucesso!']);
            return redirect()->route('home');
        }
        
    }

    public function delete(){
        $user = Auth::user();
        $this->contatosModel->where('id_user', $user->id)->delete();
        if($user->delete()){
            return redirect('/');
        }
    }
}
