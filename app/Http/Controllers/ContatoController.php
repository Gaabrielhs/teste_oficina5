<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return back()->withErrors(['duplicidade' => 'Contato já adicionado']);
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

        return view('home', ['contatos' => $data]);
    }
}
