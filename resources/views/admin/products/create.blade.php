@extends('layouts.app')

@section('content')
    
    <h1 class="display-4">Crear Produto</h1>
    <form action="{{ route('admin.products.store') }}" method="POST">
        {{-- token de validação do formulario --}}
        @csrf        

        <div class="form-group">
            <label>Nome Produto</label>
            <input class="form-control" type="text" name="name">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control" type="text" name="description">            
        </div>
        
        <div class="form-group">
            <label>Conteudo</label>            
            <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input class="form-control" type="text" name="price">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug">
        </div>

        <div class="form-group">
            <label>Lojas</label>
            <select class="form-control" name="store" id="store">
            @foreach ($stores as $store)
                <option value="{{ $store->id }}">{{ $store->name }}</option>
            @endforeach
            </select>    
        </div>
        
        <div class="form-group">
            <button class="btn btn-success" type="submit"> Criar Produto</button>
        </div>

    </form>

@endsection
