<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
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

    public function edit(Request $request){
        $data = $request->all();
        $user = Auth::user();
        if($user->email != $data['email']){
            Validator::make($data, [
                'email' => 'required|unique:users|max:255',
                'name' => 'required',
            ])->validate();
        }else{
            Validator::make($data, [
                'name' => 'required',
            ])->validate();
        }
        $user->fill($data);
        if($user->save()){
            session(['status' => 'Perfil alterado com sucesso!']);
            return redirect()->route('home');
        }
    }

    public function password(){
        return view('password');
    }

    public function editPassword(Request $request){
        $old = $request->input('oldPassword');
        $user = Auth::user();
        if(Hash::check($old, $user->password)){
            Validator::make($request->all(), [
                'password' => 'required|string|min:6|confirmed',
            ])->validate();

            $user->password = Hash::make($request->input('password'));
            if($user->save()){
                session(['status' => 'Senha alterada com sucesso!']);
                return redirect()->route('home');
            }
        }else{
            return back()->withErrors(['oldPassword' => 'Senha inválida']);
        }
    }

    public function delete(){
        $user = Auth::user();
        if($this->contatosModel->where('id_user', $user->id)->delete() && $user->delete()){
            return redirect('/');
        }
    }
}
