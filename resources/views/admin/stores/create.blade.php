@extends('layouts.app')

@section('content')
    
    <h1 class="display-4">Create Loja</h1>
    <form action="{{ route('admin.stores.store') }}" method="POST">
        {{-- token de validação do formulario --}}
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
        @csrf        
        
        <div class="form-group">
            <label>Nome Loja</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" value="{{ old('description') }}">
            
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ old('phone') }}">
            
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input class="form-control @error('mobile_phone') is-invalid @enderror" type="text" name="mobile_phone" value="{{ old('mobile_phone') }}">

            @error('mobile_phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug">
        </div>

        {{-- <div class="form-group">
            <label>Usuário</label>
            <select class="form-control" name="user" id="user">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
            </select>    
        </div> --}}
        
        <div class="form-group">
            <button class="btn btn-success" type="submit"> Criar Loja</button>
        </div>

    </form>

@endsection
