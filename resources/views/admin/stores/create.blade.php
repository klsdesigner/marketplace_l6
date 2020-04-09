@extends('layouts.app')

@section('content')
    
    <h1 class="display-4">Create Loja</h1>
    <form action="{{ route('admin.stores.store') }}" method="POST">
        {{-- token de validação do formulario --}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label>Nome Loja</label>
            <input class="form-control" type="text" name="name">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control" type="text" name="description">
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input class="form-control" type="text" name="phone">
        </div>

        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input class="form-control" type="text" name="mobile_phone">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug">
        </div>

        <div class="form-group">
            <label>Usuário</label>
            <select class="form-control" name="user" id="user">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
            </select>    
        </div>
        
        <div class="form-group">
            <button class="btn btn-success" type="submit"> Criar Loja</button>
        </div>

    </form>

@endsection
