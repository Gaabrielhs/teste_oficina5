<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Contatos;

class ContatoController extends Controller
{
    private $contato;
    //
    public function __construct(Contatos $contato)
    {
        $this->contato = $contato;
    }

    public function form($id = null){
        if($id){
            $contato = $this->contato->find($id);
            if($contato && $contato->id_user == Auth::user()->id){
                return view('contato.form', ['contato' => $contato]);
            }else{
                return redirect()->route('home');
            }
        }else{
            return view('contato.form', ['contato' => $this->contato]);
        }
    
    }

    public function store(Request $request){
        $data = $request->all();
        $messages = [
            'email.required' => 'O email é obrigatório',
            'name.required' => 'O nome é obrigatório',
            'phone_number.required' => 'O telefone é obrigatório',
            'phone_number.min' => 'Telefone inválido',
            'birthdate.required' => 'A data de nascimento é obrigatória',
        ];

        Validator::make($data, [
            'email' => 'required|unique:users|max:255',
            'name' => 'required',
            'phone_number' => 'required|min:14',
            'birthdate' => 'required|min:10'
        ], $messages)->validate();

        //retirando a máscara
        $data['phone_number'] = str_replace(['(', ')', '-', ' '], '',$data['phone_number']);

        $validation = $this->contato->where('id_user', Auth::user()->id)
            ->where('id', '<>', $data['id'])->get();

    
        $validation1 = $validation->where('email', $data['email'])->count();
        $validation2 = $validation->where('phone_number', $data['phone_number'])->count();
        if($validation1 == 0 && $validation2 == 0){
            if($data['id']){
                $contato = $this->contato->find($data['id']);
                if($contato->id_user == Auth::user()->id){
                    $contato->fill($data);
                    if($contato->save()){
                        session(['status' => 'Contato alterado com sucesso!']);
                        return redirect()->route('home');
                    }
                }
            }else{
                $this->contato->fill($data);
                $user_id = Auth::user()->id;
                $this->contato->id_user = $user_id;
                if($this->contato->save()){
                    session(['status' => 'Contato adicionado com sucesso!']);
                    return redirect()->route('home');
                }
            }
        }else{
            return back()->withErrors(['duplicidade' => 'Contato já adicionado'])->withInput();
        }
            
        
    }

    public function delete($id){
        $contato = $this->contato->find($id);
        if($contato->id_user == Auth::user()->id){
            if($contato->delete()){
                session(['status' => 'Contato excluido com sucesso!']);
                return redirect()->route('home');
            }
        }
    }

    public function search(Request $request){
        $query = $request->input('search');
        
        $data = $this->contato->where('name', 'like', '%'.$query.'%')->orWhere('phone_number', 'like', '%'.$query.'%')->get();
        $data = $data->where('id_user', Auth::user()->id);

        session(['status' => count($data).' contato(s) encontrado(s)']);
        return view('home', ['contatos' => $data]);
    }
}
