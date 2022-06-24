@extends('layouts.base')

@section('content')
      <div class=" mt-5 bg-light">
          <h1 class="display-3 text-center"> products </h1>
          <div class="article row justify-content-center">
              @foreach ($products as $product)
                  <div class="col-md-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <small class="text-danger h4">
                            </small>
                           <h5 class="card-title">{{$product->name}}</h5>
                           <p class="card-text">{{$product->price}}</p>
                           @foreach ( $product->sizes as $size)
                               <p class="">{{$size->name}}</p>
                           @endforeach
                           <img src={{$product->picture->name}} alt="">
                            <p class="">{{$product->category->name}}</p>
                       </div>
                   </div>
                 </div>
              @endforeach
          </div>
            <div class="d-flex justify-content-center mt-5">
              
          </div>
         
      </div> 
      @endsection