@extends('layouts.app')

@section('content')
    
    <h1 class="display-4">Atualização de Produto</h1>
    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST">
        {{-- token de validação do formulario --}}
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nome Produto</label>
            <input class="form-control" type="text" name="name" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control" type="text" name="description" value="{{ $product->description }}">            
        </div>
        
        <div class="form-group">
            <label>Conteudo</label>            
            <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{$product->body}}</textarea>
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input class="form-control" type="text" name="price" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug" value="{{ $product->slug }}">
        </div>
        
        <div class="form-group">
            <button class="btn btn-success" type="submit"> Atualizar Produto</button>
        </div>

    </form>

@endsection
