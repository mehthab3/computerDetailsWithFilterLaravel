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
<body>
  <center><h1>Add New Product</h1></center>
<div class="container">
<form action="{{ url("/newproduct") }}" enctype="multipart/form-data" method="post"  onsubmit="return validation()" >
{{ csrf_field() }}

    <label>Name</label>
    <input type="text" name="name"  required>
    
  <label>Price</label>
  <input type="text" name="price" required>

   <label>Brand</label>
   <select name="brand">
       <?php foreach ($brands as $key => $brand) {
      
          echo "<option value=$brand->name>$brand->name</option>";
       
      }
      ?>
   </select>
   <!-- <input type="text" name="brand" required> -->

      <label>Processor Type</label>
      <select name="processortype">
         <?php foreach ($processortypes as $key => $processortype) {
        
            echo "<option value=$processortype->name>$processortype->name</option>";
         
        }
        ?>
   </select>
   <!-- <input type="text" name="processortype" required> -->

      <label>Screen Size</label>
   <input type="text" name="screensize" required>

    <label>Touch Screen</label>
   <!-- <input type="text" name="touchscreen" required> -->
    <select name="touchscreen">
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>

     
      <label>Availability</label>
     <select name="availability">
    <option value="Yes">Yes</option>
    <option value="No">No</option>
    </select>

      <label>Image</label>
   <input type="file" class="custom-file-upload" name="image" required>

 <br>
<input type="submit" name="submit" value="Submit" >
<input type="reset" name="reset" value="Reset">

 
 </form>
<input type="submit" value="Cancel" onclick="location.href='products'";/>
<br> 
</div>

 </body>
 </html>
 