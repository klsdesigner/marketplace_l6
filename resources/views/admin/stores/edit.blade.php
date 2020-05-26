@extends('layouts.app')

@section('content')
    
    <h1 class="display-4">Atualização de Loja</h1>
    <form action="{{ route('admin.stores.update', ['store' => $store->id]) }}" method="POST" enctype="multipart/form-data">
        {{-- token de validação do formulario --}}
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nome Loja</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $store->name }}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input class="form-control @error('discription') is-invalid @enderror" type="text" name="description" value="{{ $store->description }}">

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ $store->phone }}">

            @error('phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input class="form-control @error('mobile_phone') is-invalid @enderror" type="text" name="mobile_phone" value="{{ $store->mobile_phone }}">

            @error('mobile_phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <p>
                <img src="{{ asset('storage/' . $store->logo) }}" alt="">
            </p>
            <label>Logo da Loja</label>
            <input type="file" name="logo" class="form-control">
        </div>

        {{-- <div class="form-group">
            <label>Slug</label>
            <input class="form-control" type="text" name="slug" value="{{ $store->slug }}">
        </div> --}}
               
        <div class="form-group">
            <button class="btn btn-primary" type="submit"> Atualizar Loja</button>
        </div>

    </form>

@endsection
