<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/med_man2.png" />
    <title>show-All-Medicine</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<style>
  <?php include "styles/style.css" ?>
  .tooltip {
  position: relative;
  display: inline-block;
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
  width: 120px;
  bottom: 100%;
  left: 50%;
  margin-left: -60px;
  font-size: .6rem;
  letter-spacing:1.6px;
  text-transform:uppercase;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}
.tooltip .tooltiptext2 {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  letter-spacing:1.6px;
  text-transform:uppercase;
  border-radius: 6px;
  top: -5px;
  right: 105%;
  font-size: .6rem;
  letter-spacing:1px;
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
}
.tooltip:hover .tooltiptext2 {
  visibility: visible;
}


</style>

<section class="main">
<?php
  include 'navbar.php';
?>
	<div class="container">
    <div class="search">
                <div class="image">
                    <img src="img/find.svg" alt="">
                </div>
                <input type="text" placeholder="Search medicine...." id="search_med">
    </div>
        
       <br>
       <div class="table-border">
       <div class="table-box">
    <table cellpadding="5" class="table table-hover table-striped table-condensed table-bordered">
        <thead>
            <tr>
                <th class="text-center">S.No</th>
                <th class="text-center">Medicine Name</th>
                <th class="text-center">Company Name</th>
                <th class="text-center">Rack No</th>
                <th class="text-center">Expiry</th>
                <th class="text-center">Price</th>
                <th class="text-center">Total Quant.</th>
                <th class="text-center">action </th>
            </tr>
        </thead>
        <tbody id="show_data">
        <?php

include 'connection.php';

$sql ="select * from add_med";

$query =mysqli_query($con, $sql);

while($rows = mysqli_fetch_assoc($query))
{
?>

<tr>
<td class="change"><?php echo $rows['s.no']; ?></td>
<td class="py-2"><?php echo $rows['name']; ?></td>
<td class="py-2"><?php echo $rows['comname']; ?></td>
<td class="py-2"><?php echo $rows['Rack']; ?> </td>
<td class="py-2"><?php echo $rows['exp']; ?> </td>
<td class="py-2">Rs. <?php echo $rows['selling_price']; ?> </td>
<td class="py-2"><?php echo $rows['total_quantity']; ?> </td>
<td class="change-img"><div class="tooltip"><a href="#" ><img src="img/edit.svg" alt=""></a> <span class="tooltiptext">Update Medicine</span> </div>
<div class="tooltip"><a href="#"><img src="img/delete.svg" alt=""></a><span class="tooltiptext2">Delete Medicine</span></div> </td>
    
<?php
}

?>
        </tbody>
    </table>

    </div>
    </div>
</div>
</section>
<script type="text/javascript">
$(document).ready(function(){
$("#search_med").on("keyup",function(){
var search_term = $(this).val();
$.ajax({
    url: "live-search.php",
    type: "POST",
    data: {search:search_term},
    success: function(data){
         $("#show_data").html(data);
    }
});
});
});
</script>
</body>
</html>