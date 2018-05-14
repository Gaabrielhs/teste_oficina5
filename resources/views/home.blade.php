@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Contatos
                    <div class="float-right">
                        <a href="{{ route('contato') }}" class="btn btn-sm btn-info">Adicionar</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @php
                            session(['status' => false]);
                        @endphp
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Data de Nasc</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contatos as $contato)
                            <tr>
                                <th>{{ $contato->id }}</td>
                                <td>{{ $contato->name }}</td>
                                <td>{{ $contato->email }}</td>
                                <td>{{ $contato->phone_number }}</td>
                                <td>{{ $contato->birthdate }}</td>
                                <td><a class="btn btn-info" href="{{ route('contato', ['id' => $contato->id]) }}">+</a></td>
                                <td><a class="btn btn-danger" href="{{ route('delete.contato', ['id' => $contato->id]) }}">-</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
