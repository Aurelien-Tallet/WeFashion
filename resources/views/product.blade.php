@extends('layouts.base')
@section('content')
    <div class=" mt-5 ">
        <h1 class="display-3 pt-3 text-center text-uppercase">
            {{ $product->name }}</h1>
    </div>
    <div class="flex justify-content-center">
        <div class="col-md-3 ">
            <div class=" my-3 bg-transparent">
                <div class="card-body">
                    <div class="picture-wrapper">
                        <img class="mg-responsive picture" src={{ asset('/storage/image/' . $product->picture->name) }}
                            alt="">
                    </div>
                    <div class="flex w-full justify-content-between py-2">
                        <p class="card-text price">{{ $product->price }}€</p>
                    </div>
                    <div class="description py-2">
                        <p class="card-text">{{ $product->description }}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3 pt-20 form">
            <div class=" my-3 bg-transparent ">
                <form action="">
                    <div class="form-group">
                        <div class="block block flex flex-row justify-content-between align-items-center w-50 p-1">
                            <label for="quantity">Quantité : </label>
                            <input type="number" class="w-20" id="quantity" name="quantity" value="1">
                        </div>
                        <div class="block flex flex-row justify-content-between align-items-center w-50 p-1">
                            <label for="size" class="h-full">Taille : </label>
                            <select name="" id="size" class="align-self-end w-20 ">
                                @foreach ($product->sizes as $size)
                                    <option class="">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn text-uppercase border-dark rounded ">Ajouter au
                        panier</button>
                </form>
            </div>
        </div>
    </div>

    </div>
@endsection
