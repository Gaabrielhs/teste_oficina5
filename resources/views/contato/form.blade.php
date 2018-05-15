@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contato</div>
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
            
                    <form method="POST" action="{{ route('add.contato') }}">
                        @csrf
                       <input type="hidden" name="id" value="{{ $contato->id }}">
                        <div class="form-group">
                            <label for="name">Nome</label>    
                            <input type="text" name="name" id="name" class="form-control" value="{{ $contato->name }}{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>    
                            <input type="email" name="email" id="email" class="form-control" value="{{ $contato->email }}{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Telefone</label>    
                            <input type="tel" name="phone_number" id="phone_number" class="form-control" maxlength="15" value="{{ $contato->phone_number }}{{ old('phone_number') }}">
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Data de Nascimento</label>    
                            <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ $contato->birthdate }}{{ old('birthdate') }}">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Salvar" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
