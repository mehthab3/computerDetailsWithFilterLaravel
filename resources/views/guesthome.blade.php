

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
.form-inline{
	display: flex;
}

</style>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
  <link href="bootstrap-slider.css" rel="stylesheet">
<script src="bootstrap-slider.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>

	 minVal = "<?php echo $filter['values'][0]; ?>";
	 maxVal = "<?php echo $filter['values'][1]; ?>";

  $( function() {
    $( "#slider-range" ).slider({

      // var minVal =;	
      
      range: true,
      min: 0,
      max: 200000,
      values: [ minVal, maxVal ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "₹" + ui.values[ 0 ] + "-₹" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "₹" + $( "#slider-range" ).slider( "values", 0 ) +
      "-₹" + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  </script>

</head>
<center>
  <br/>
  <br/>
<body>

<!-- <form action="/create" method="get">
</form> -->

<div class="container"> 

<table id="docs" align="center">
<div class="container">
        <form action="/search" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                    placeholder="Search Products"><span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Search
                        
                    </button>
                </span>
            </div>
        </form>
</div>
<br>

<form action="/filter"  id =new method="POST" role="filter">
            {{ csrf_field() }}
            <div class="row">
                
                <div class="form-inline" >
					<p style="width: 100px">
					  <label for="amount">Price range:</label>
					</p>
 
					<div id="slider-range" style="width: 100px; margin-left: 10px;margin-top: 6px;">
						<input type="text" id="amount" name="values" value="min" style="border:0; color:#f6931f; font-weight:bold; margin-top: 10px;width: 100px">
					</div>
<br>
                    <div class="form-group" style="margin-left: 10px">
                        <select name="brand" id="brand" class="form-control">
                        	@if(!empty($filter['brand']))
                        	<option value="{{ $filter['brand'] }}" selected>{{ $filter['brand'] }}</option>
                        	@foreach($brands as $brandn)
                        	@if($filter['brand'] != $brandn->brand)	
                            <option value="{{ $brandn->brand }}">{{ $brandn->brand }}</option>
                            @endif
                            @endforeach
                        	@else
                            <option value=""disabled selected>Select Brand</option>
                            @foreach($brands as $brandn)	
                            <option value="{{ $brandn->brand }}">{{ $brandn->brand }}</option>
                            	
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="processortype" id="processortype" class="form-control">
                            @if(!empty($filter['processortype']))
                        	<option value="{{ $filter['processortype'] }}" selected>{{ $filter['processortype'] }}</option>
                        	@foreach($processortype as $processortypes)
                        	@if($filter['processortype'] != $processortypes->processortype)
                        	<option value="{{ $processortypes->processortype }}">{{ $processortypes->processortype}}</option>
                            @endif
                            @endforeach
                        	@else
                            <option value="" disabled selected>Select Processor type </option>
                            @foreach($processortype as $processortypes)
                            	
                            <option value="{{ $processortypes->processortype }}">{{ $processortypes->processortype }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="screensize" id="screensize" class="form-control">
                        	@if(!empty($filter['screensize']))
                        	<option value="{{ $filter['screensize'] }}" selected>{{ $filter['screensizeKey'] }}</option>
                        	@foreach($screensize as $key=> $screensizes)
                        	@if($filter['screensize'] != $screensizes['id'])
                        	<option value="{{ $screensizes['id'] }}">{{ $key}}</option>
                            @endif
                            @endforeach
                        	@else

                            <option value=""disabled selected>Select Screen size</option>
                            @foreach($screensize as $key=> $screensizes)
                            	
                            <option value="{{ $screensizes['id'] }}">{{ $key }}</option>
                            	
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="availability" id="availability" class="form-control">
                        	@if(!empty($filter['availability']))
                            <option value="Yes" <?php if($filter['availability'] == 'Yes') echo "selected"; ?>>Yes</option>
                            <option value="No" <?php if($filter['availability'] == 'No') echo "selected"; ?> >No</option>
                            @else
                            <option value=""disabled selected>Select Availablitiy</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="touchscreen" id="touchscreen" class="form-control">
                            @if(!empty($filter['touchscreen']))
                            <option value="Yes" <?php if($filter['touchscreen'] == 'Yes') echo "selected"; ?>>Yes</option>
                            <option value="No" <?php if($filter['touchscreen'] == 'No') echo "selected"; ?> >No</option>
                            @else
                            <option value=""disabled selected>Select Touch Screen</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            @endif
                        </select>
                    </div>
                  
                    
                </div>

            </div>
            <div class="form-group" align="center">
                        <button type="submit" name="filter" id="filter" class="btn btn-info">Filter</button>

                        <button type="reset" onclick="location.href='guesthome'" name="reset" id="reset" class="btn btn-default">Clear Filter</button>
                    </div>
        </form>

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
    </tr>
    </tr>

      @endforeach
</table>

@endif 
</div>
</center>
 </form>
 </body>
</html>
<script>

 $('#reset').click(function(){
 // 	var minVal= 1000;
	// var maxVal= 200000;
        $('#availability').val();
        $('#touchscreen').val();
        $('#processortype').val();
       $('#brand').val();
        $('#screensize').val();
        $('#values').val();

        $('#docs').DataTable().destroy();
        fill_datatable();
    });

 // });

 </script>