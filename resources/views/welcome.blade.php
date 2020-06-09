@extends('layouts.front')

@section('content')

    <div class="row ">

        @foreach ($products as $key => $product)
        
            <div class="col-md-4">

                <div class="card">
                    {{-- Verifico se existe imagem --}}
                    @if ($product->photos->count())
                        <img class="card-img-top" src="{{asset('storage/' . $product->photos->first()->image) }}" alt="">    
                    @else    
                        <img class="card-img-top" src="{{asset('assets/img/no-photo.jpg') }}" alt="">    
                    @endif
                            
                    <div class="card-body">
                    
                    <h2 class="card-title">{{ $product->name }}</h2>
                    <p class="card-text">{{ $product->description }}</p>

                    <h3>
                        R$ {{ number_format($product->price, '2', ',', '.') }}
                    </h3>

                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-primary">Ver Produto</a>
                    
                    </div>
            
                </div>

            </div>

            @if (($key + 1) % 3 == 0)
                </div><div class="row mt-4">            
            @endif

        @endforeach

    </div>
    
@endsection