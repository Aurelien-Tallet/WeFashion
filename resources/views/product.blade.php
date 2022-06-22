<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <title>Product</title>
</head>
<body>          
      <div class=" mt-5 bg-light">
          <h1 class="display-3 text-center"> single product </h1>
          <div class="article row justify-content-center">
                  <div class="col-md-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <small class="text-danger h4">
                            </small>
                           <h5 class="card-title">{{$product->name}}</h5>
                           <p class="card-text">{{$product->price}}</p>
                           <img src={{$product->picture->name}} alt="">
                            <p class="">{{$product->category->name}}</p>
                       </div>
                   </div>
                 </div>
          </div>
            <div class="d-flex justify-content-center mt-5">
              
          </div>
         
      </div> 
</body>
</html>