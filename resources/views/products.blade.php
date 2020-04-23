
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
input[type=button] {
  width: 40%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
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
<table id="docs">
  <input type="button" class="button button1" value="Add New Product" onclick="location.href='newproduct';" >
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
    <td id="new" colspan="2">Actions</td>
  </tr>

  @if(count($products) > 0)
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

      <td action = "{{ url('/edit',array($product->id)) }}"><a href = {{ url('/update',array($product->id)) }}>Update</a></td>
      <td action = "{{ url('/delete',array($product->id)) }}"><a href = {{ url('/delete',array($product->id)) }}>Delete</a></td>
    </tr>
    </tr>
      @endforeach
    </table>
    {!! $products->render() !!}
    @endif
</center>
  </form>
  </div>
 </body>
</html>
