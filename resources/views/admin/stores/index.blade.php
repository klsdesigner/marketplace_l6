@extends('layouts.app')

@section('content')

    <h1 class="display-4 mb-4">Listagem de Lojas</h1>

    @if (!$store)
        <a href="{{ route('admin.stores.create') }}" class="btn btn-success btn-lg mb-4">CRIAR LOJA</a>   
    @else  
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Total Produtos</th>
                    <th>ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($stores as $store) --}}
                    <tr>
                        <td>{{$store->id}}</td>
                        <td>{{$store->name}}</td>
                        <td>{{ $store->products->count() }}</td>
                        <td>      
                            <div class="btn-group">                  
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.stores.edit', ['store' => $store->id]) }}">EDITAR</a>
                                
                                <form action="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" method="post">                            
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                                </form> 
                                {{-- <a class="btn btn-sm btn-danger" href="{{ route('admin.stores.destroy', ['store' => $store->id]) }}">REMOVER</a> --}}
                            </div>
                        </td>
                    </tr>
                {{-- @endforeach  --}}
            </tbody>
        </table>
     
        {{-- paginação --}}
        {{-- {{ $stores->links() }} --}}
    @endif

@endsection
