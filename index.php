
<!doctype html>
<html lang="en">
  <head>
    <title>Table/2</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
    <div class="row ">
  <form method="post" class="col-12 mt-5">
  <div class="form-group"> 
    <input type="text" name="name" class="form-control" id="exampleInputEmail1"  placeholder="Enter name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>"> 
  </div>
  <div class="form-group">  
    <select class="form-control" name="city" id="exampleFormControlSelect1">
      <option>city</option>
      <option <?php  if(isset($_POST['city']) && $_POST['city'] == 'cairo'){echo 'selected';}  ?> value="cairo">cairo</option>
      <option <?php  if(isset($_POST['city']) && $_POST['city'] == 'giza'){echo 'selected';}  ?> value="giza">giza</option>
      <option <?php  if(isset($_POST['city']) && $_POST['city'] == 'alex'){echo 'selected';}  ?> value="alex">alex</option>
      <option <?php  if(isset($_POST['city']) && $_POST['city'] == 'other'){echo 'selected';}  ?> value="other">other</option>
    </select>
  </div>
  <div class="form-group"> 
  <input type="number" class="form-control" name="number" value="<?php if(isset($_POST['number'])){echo $_POST['number'];} ?>">
  </div>
  <button type="submit" name="submit" class="btn btn-primary w-100">product</button>

</div>
  


     
  <?php
 
  if(isset($_POST['submit'])){ 
  $name = $_POST['name'];
  $number = $_POST['number'];
   ?>
    <table class="table">
  <thead>
    <tr>
        <th>product</th>
        <th>price</th>
        <th>quntity</th>
    </tr>
  </thead>
  <tbody>

<?php


for($i = 1 ; $i <= $number ; $i++){?>
         <tr>
           <td> <input type='text' name='productName<?php echo$i?>'  class='form-control' placeholder='proudact name'></td>
           <td> <input type='text' name='productPrice<?php echo$i?>'  class='form-control' placeholder='price'></td>
           <td> <input type='text' name='productQuantity<?php echo $i?>'  class='form-control' placeholder='quantity'></td>
         </tr>

     <?php  }   ?>
  </tbody>

</table>

<button type="submit" name="calc" class="btn btn-primary w-100">calculate</button>
<?php
} 



 


if(isset($_POST['calc'])){

$number = $_POST['number'];


echo "<table class='table'>  
<thead>
<tr>
    <th>product</th>
    <th>price</th>
    <th>quntity</th>
    <th>subTotal</th>
</tr>
</thead>
<tbody> 

" ;
$totalprice = 0;
// print_r($_POST);die;
for($i = 1 ; $i <= $number ; $i++){
  $productName = $_POST['productName'.$i];
  $productPrice = $_POST['productPrice'.$i];
  $productQuantity = $_POST['productQuantity'.$i];
  $subTotal = $productQuantity * $productPrice;
  $totalprice += $subTotal;
echo "<tr>";
echo " <td>". $productName ."</td>";

echo "<td>".$productPrice."</td>";

echo "<td>".$productQuantity  ."</td> " ;
echo "<td>" . $subTotal . "</td>";
echo "</tr>";

}
$discount = getDiscount($totalprice);
$deleivery = getDeleviery($_POST['city']);
$totalAfterDiscount = $totalprice - $discount;
$netprice = $totalAfterDiscount + $deleivery;

echo"
<tr>
<td colspan=3> client name </td> 
<td> " . $_POST['name']."</td>
</tr>
<tr>
<td colspan=3> city </td> 
<td> ".$_POST['city'] ."  </td>
</tr> 
<tr>
<td colspan=3> total </td> 
<td> $totalprice  </td>
</tr>
<tr>
<td colspan=3> discount </td> 
<td> ".$discount  ."</td>
</tr>
<tr>
<td colspan=3> totalAfterDiscount </td> 
<td> ". $totalAfterDiscount ."</td>
</tr>
<tr>
<td colspan=3> deleivery </td> 
<td> ". $deleivery ."</td>
</tr>
<tr>
<td colspan=3> netPrice </td> 
<td> ". $netprice ."</td>
</tr>

</tbody>";
echo "</table>";
}

function getDiscount($price){
   if($price < 1000){
     return 0 ;
   }elseif($price < 3000 && $price >= 1000 ){
     return $price * 0.1;
   }elseif($price < 4500 && $price >= 3000 ){
    return $price * 0.15;
  }else{
    return $price * 0.2;
  }
}

function getDeleviery($city){
  switch($city){
    case 'cairo' : return 0  ;
    case 'giza' : return 30  ;
    case 'alex' : return 50  ;
    case 'other' : return 100  ;
  }

}

  # code...


?>
</form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
