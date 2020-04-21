@extends('layouts.app')

@section('content')
    
    <h1 class="display-4">Atualização de Categoria</h1>
    <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
        {{-- token de validação do formulario --}}
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nome da Categorias</label>
            <input class="form-control" type="text" name="name" value="{{ $category->name }}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control" type="text" name="description" value="{{ $category->description }}">            
        </div>
        
        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug" value="{{ $category->slug }}">
        </div>
        
        <div class="form-group">
            <button class="btn btn-success" type="submit"> Atualizar Categoria</button>
        </div>

    </form>

@endsection
