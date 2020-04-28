@extends('layouts.app')

@section('content')
    
    <h1 class="display-4">Crear Produto</h1>
    <form action="{{ route('admin.products.store') }}" method="POST">
        {{-- token de validação do formulario --}}
        @csrf        

        <div class="form-group">
            <label>Nome Produto</label>
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
            <label>Conteudo</label>            
            <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30" rows="10">{{old('body')}}</textarea>

            @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" value="{{ old('price') }}">

            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Categorias</label>
            <select name="categories[]" id="categories" class="form-control" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug">
        </div>

        {{-- <div class="form-group">
            <label>Lojas</label>
            <select class="form-control" name="store" id="store">
            @foreach ($stores as $store)
                <option value="{{ $store->id }}">{{ $store->name }}</option>
            @endforeach
            </select>    
        </div> --}}
        
        <div class="form-group">
            <button class="btn btn-success" type="submit"> Criar Produto</button>
        </div>

    </form>

@endsection
