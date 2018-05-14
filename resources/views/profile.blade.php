@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfil</div>
                <div class="card-body">
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('edit.user') }}">
                        @csrf
                    
                        <div class="form-group">
                            <label for="name">Nome</label>    
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>    
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <a href="{{ route('password') }}">Alterar senha?</a>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Salvar" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
