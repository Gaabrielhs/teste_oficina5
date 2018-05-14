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
                @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @php
                            session(['status' => false]);
                        @endphp
                    @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('search') }}" class="mb-2">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" name="search" placeholder="Digite o nome ou o telefone" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" value="Buscar" class="btn btn-info form-control">
                            </div>
                        </div>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
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
                                <th>{{ $loop->index+1 }}</td>
                                <td>{{ $contato->name }}</td>
                                <td>{{ $contato->email }}</td>
                                <td>{{ $contato->phone_number }}</td>
                                <td>{{ date("d/m/Y", strtotime($contato->birthdate)) }}</td>
                                <td><a class="btn btn-info" href="{{ route('contato', ['id' => $contato->id]) }}">+</a></td>
                                <td><a class="btn btn-danger" href="{{ route('delete.contato', ['id' => $contato->id]) }}">x</a></td>
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
