<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/med_man2.png" />
    <title>Add-history</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<style>
  <?php include "styles/style.css" ?>
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
                <input type="text" placeholder="Type medicine or Date...." id="search_med">
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
                <th class="text-center">Expiry</th>
                <th class="text-center">Buying Price</th>
                <th class="text-center">Selling Price</th>
                <th class="text-center">Total Quant.</th>
                <th class="text-center">Date </th>
                <th class="text-center">Time </th>
            </tr>
        </thead>
        <tbody id="show_data">
        <?php

include 'connection.php';

$sql ="select * from add_history order by `s.no` desc";

$query =mysqli_query($con, $sql);

while($rows = mysqli_fetch_assoc($query))
{
?>

<tr>
<td class="change"><?php echo $rows['s.no']; ?></td>
<td class="py-2"><?php echo $rows['name']; ?></td>
<td class="py-2"><?php echo $rows['comname']; ?></td>
<td class="py-2"><?php echo $rows['expiry']; ?> </td>
<td class="py-2">Rs. <?php echo $rows['buying_price']; ?> </td>
<td class="py-2">Rs. <?php echo $rows['selling_price']; ?> </td>
<td class="py-2"><?php echo $rows['quantity']; ?> </td>
<td class="py-2"><?php echo $rows['date']; ?> </td>
<td class="py-2"><?php echo $rows['time']; ?> </td></tr>

    
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
    url: "live-addhistory-search.php",
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