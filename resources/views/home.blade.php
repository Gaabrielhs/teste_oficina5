@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    @foreach($contatos as $contato)
                        <div>Nome: {{ $contato->name }}</div></br>
                        <div>Email: {{ $contato->email }}</div></br>
                        <div>Telefone: {{ $contato->phone_number }}</div></br>
                        <div>Data de Nascimento: {{ $contato->birthdate }}</div></br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
