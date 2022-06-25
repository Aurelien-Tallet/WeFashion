@extends('layouts.base')

@section('content')
    <div class=" pt-5 bg-light p-3">
        <h1 class="display-3 mt-6 pt-3 text-center text-uppercase page"> {{ $title }} </h1>
        <div class="article row justify-content-center">
            @foreach ($products as $product)
                <div class="col-md-4 product-card">
                    <div class="card my-3 bg-transparent">
                        <div class="card-body">
                            <div class="flex w-full justify-content-between py-2">
                                <h5 class="title"><a href={{ route('products.show', $product->id) }}>
                                        {{ $product->name }}</a></h5>
                                <p class="card-text price">{{ $product->price }}€</p>
                            </div>
                            <div class="picture-wrapper">
                                <img class="mg-responsive picture" src={{ asset('/storage/image/' . $product->picture->name) }}
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>

    </div>
@endsection
