

@include('layouts.app')

<!DOCTYPE html>
<html>


<head>


<style>
#docs {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#docs td, #docs th {
    border: 1px solid #ddd;
    padding: 8px;
}

#new {
    padding-top: 12px;
    padding-bottom: 12px;
    background-color: blue;
    color: white;
    text-align: center;
}

#docs tr:nth-child(even){background-color: #f2f2f2;}

#docs tr:hover {background-color: #ddd;}

#docs th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>
<center>
<body>

<!-- <form action="/create" method="get">
</form> -->
<div class="container"> 

<table id="docs" align="center">
<div class="container">
        <form action="/search" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
              @if(count($search) <> 0)
                <input type="text" class="form-control" name="q"
                    value={{$search}}><span class="input-group-btn">
              @else
                <input type="text" class="form-control" name="q"
                    placeholder="Search Products"><span class="input-group-btn">
              @endif        
                    <button type="submit" class="btn btn-default">Search
                      
                    </button>
                    
                </span>
            </div>
        </form>
</div>

@if(count($products) == 0)
{{"No search results for $search"}}
@elseif(count($products) > 0)
{{"Search results for $search are:"}}
<h2><center><strong>Products</center></strong></h2>

  <tr>
    <th>Name</th>
    <th>Price</th>
    <th>Brand</th>
     <th>Processor Type</th>
    <th>Screen Size</th>
    <th>Touch Screen</th>
     <th>Availability</th>
    <th>Image</th>
  </tr>

  <!-- if(Session::get("msg")){
  {!! Session::has('msg') ? Session::get("msg") : '' !!}
	} -->

  
      @foreach($products->all() as $product)
    <tr>
      <td>{{$product->name}}</td>
      <td>{{$product->price}}</td>
      <td>{{$product->brand}}</td>
      <td>{{$product->processortype}}</td>
      <td>{{$product->screensize}}</td>
      <td>{{$product->touchscreen}}</td>
      <td>{{$product->availability}}</td>
      <!-- <td> <img src="$product->image"></td>  -->
      <td> <img src="{{url('uploads/'.$product->image)}}" alt="{{$product->image}}" width="100px;" height="100px;"></td> 
    </tr>
    </tr>

      @endforeach
</table>
  {!! $products->render() !!}

@endif 
</div>
</center>
 </form>
 </body>
</html>
