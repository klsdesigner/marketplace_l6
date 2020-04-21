@extends('layouts.app')

@section('content')

    <h1 class="display-4 mb-4">Listagem de Categorias</h1>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-lg mb-4">NOVA CATEGORIA</a>
    
    <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Descrição</th>                
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>                    
                    <td>{{$category->name}}</td>   
                    <td>{{ $category->description }}</td>                                     
                    <td>                        
                        <div class="btn-group">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">EDITAR</a>
                        
                            <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="post">                            
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

    {{ $categories->links() }}

@endsection
