@extends('layouts.app')

@section('content')

    <h1 class="display-4">Listagem de Lojas</h1>

    <a href="{{ route('admin.stores.create') }}" class="btn btn-success btn-lg">CRIAR LOJA</a>
    
    <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stores as $store)
                <tr>
                    <td>{{$store->id}}</td>
                    <td>{{$store->name}}</td>
                    <td>                        
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.stores.edit', ['store' => $store->id]) }}">EDITAR</a>
                        
                        <a class="btn btn-sm btn-danger" href="{{ route('admin.stores.destroy', ['store' => $store->id]) }}">REMOVER</a>
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>

    {{ $stores->links() }}

@endsection
