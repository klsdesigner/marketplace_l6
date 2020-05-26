@extends('layouts.app')

@section('content')
    
    <h1 class="display-4">Criar Categorias</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        {{-- token de validação do formulario --}}
        @csrf        

        <div class="form-group">
            <label>Nome da Categoria</label>
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

        {{-- <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug">
        </div> --}}
        
        <div class="form-group">
            <button class="btn btn-success" type="submit"> Criar Categoria</button>
        </div>

    </form>

@endsection
