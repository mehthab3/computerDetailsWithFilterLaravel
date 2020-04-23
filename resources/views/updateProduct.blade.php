@include('layouts.app')

<html>
<head> 
<link rel="stylesheet" href="/css/style.css">
<script type="text/javascript" src="/js/jquery.validation.js"></script>
</head>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea,[type=file] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit],[type=reset] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

</style>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/css/style.css">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Enter the Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>
<body>

<div class="container">
<h1>Product Description</h1>
<form method = "POST" enctype="multipart/form-data" action = "{{ url('/edit',array($products->id)) }}">
{{ csrf_field() }}
<label>name:</label>
  <input type="text" name="name" value ="<?php echo $products->name; ?>" required/>
  <label>Price:</label>
    <input type="text" name="price" value ="<?php echo $products->price; ?>"/>
    <label>Brand:</label>
    <input type="text" name="brand" value ="<?php echo $products->brand; ?>" required/>
    <label>Processor Type:</label>
  <input type="text" name="processortype" value ="<?php echo $products->processortype; ?>" required/>
  <label>Screen Size:</label>
    <input type="text" name="screensize" value ="<?php echo $products->screensize; ?>"/>
    <label>Touch Screen</label>
   <!-- <input type="text" name="touchscreen" required> -->
    <select name="touchscreen">
      <option value="Yes"    <?php if($products->touchscreen == 'Yes') echo "selected"; ?> >Yes</option>
      <option value="No" <?php if($products->touchscreen == "No") echo "selected"; ?> >No</option>
    </select>

     
      <label>Availability</label>
     <select name="availability">
    <option value="Yes" <?php if($products->touchscreen == 'Yes') echo "selected"; ?> >Yes</option>
    <option value="No" <?php if($products->touchscreen == 'No') echo "selected";?>>No</option>
    </select>
  <label>Image:</label>
    <input type="file" name="image" value ="<?php echo $products->image; ?>"/>


  <input type="submit" name="submit" value="Update">
 
 </form>
</div>
 </body>
</html>