@extends('layouts.app')

@section('content')
    
    <h1 class="display-4">Atualização de Produto</h1>
    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
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
            <label>Categorias</label>
            <select name="categories[]" id="categories" class="form-control" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @if ($product->categories->contains($category)) selected @endif
                    >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Fotos do Produto</label>
            <input type="file" name="photos[]" class="form-control @error('photos') is-invalid @enderror" multiple>
            
            @error('photos')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug" value="{{ $product->slug }}">
        </div>
        
        <div class="form-group">
            <button class="btn btn-success" type="submit"> Atualizar Produto</button>
        </div>

    </form>

    <h1 class="display-4">Listagem de imagens</h1>

    <hr>

    <div class="row mb-4">
        @foreach ($product->photos as $photo)
            <div class="col-2 text-right">
                <img src="{{ asset('storage/'. $photo->image) }}" alt="" class="img-fluid">

                <form action="{{ route('admin.photo.remove') }}" method="post">
                    @csrf

                    <input type="hidden" name="photoName" value="{{ $photo->image }}">
                    <button type="submit" class="btn btn-lg btn-danger">X</button>
                </form>
            </div>
        @endforeach
    </div>

@endsection
