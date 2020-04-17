@extends('layouts.app')

@section('content')

    <h1 class="display-4 mb-4">Listagem de Produtos</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-lg mb-4">NOVO PRODUTO</a>
    
    <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Preço</th>
                <th>Lojas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>                    
                    <td>{{$product->name}}</td>
                    <td>r$ {{number_format($product->price, 2, ',', '.')}}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>                        
                        <div class="btn-group">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.products.edit', ['product' => $product->id]) }}">EDITAR</a>
                        
                            <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="post">                            
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                            </form> 
                        </div>                                               
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>

    {{ $products->links() }}

@endsection
