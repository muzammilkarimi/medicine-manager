<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/med_man2.png" />
    <title>Empty Soon Medicine</title>
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
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
.tooltip:hover .tooltiptext2 {
  visibility: visible;
}
.filter-box {
    text-align: center;
    margin: 20px auto;
}
.filter-box select, .filter-box button {
    padding: 8px 12px;
    font-size: 1rem;
    border-radius: 4px;
    border: 1px solid #ccc;
}
.filter-box button {
    background-color: #2b2b2b;
    color: white;
    cursor: pointer;
}
</style>

<section class="main">
<?php
  include 'navbar.php';
  
  $threshold = isset($_GET['threshold']) ? (int)$_GET['threshold'] : 10;
?>
	<div class="container">
        <h1 class="page-title">Empty Soon Medicines</h1>
        
        <div class="filter-box">
            <form action="" method="GET">
                <label for="threshold">Show items with quantity less than: </label>
                <select name="threshold" id="threshold">
                    <option value="5" <?php if($threshold == 5) echo 'selected'; ?>>5</option>
                    <option value="10" <?php if($threshold == 10) echo 'selected'; ?>>10</option>
                    <option value="20" <?php if($threshold == 20) echo 'selected'; ?>>20</option>
                    <option value="50" <?php if($threshold == 50) echo 'selected'; ?>>50</option>
                </select>
                <button type="submit">Filter</button>
            </form>
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
        <tbody>
        <?php

include 'connection.php';

$sql = "SELECT * FROM add_med WHERE total_quantity < ? ORDER BY total_quantity ASC";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $threshold);
$stmt->execute();
$query = $stmt->get_result();

if ($query->num_rows > 0) {
    while($rows = $query->fetch_assoc())
    {
    ?>
    <tr>
    <td class="change"><?php echo $rows['s.no']; ?></td>
    <td class="py-2"><?php echo $rows['name']; ?></td>
    <td class="py-2"><?php echo $rows['comname']; ?></td>
    <td class="py-2"><?php echo $rows['Rack']; ?> </td>
    <td class="py-2"><?php echo $rows['exp']; ?> </td>
    <td class="py-2">Rs. <?php echo $rows['selling_price']; ?> </td>
    <td class="py-2" style="color: red; font-weight: bold;"><?php echo $rows['total_quantity']; ?> </td>
    <td class="change-img">
        <div class="tooltip"><a href="edit_medicine.php?id=<?php echo $rows['s.no']; ?>" ><img src="img/edit.svg" alt=""></a> <span class="tooltiptext">Update Medicine</span> </div>
        <div class="tooltip"><a href="delete_medicine.php?id=<?php echo $rows['s.no']; ?>" onclick="return confirm('Are you sure you want to delete this medicine?');"><img src="img/delete.svg" alt=""></a><span class="tooltiptext2">Delete Medicine</span></div> 
    </td>
    </tr>
    <?php
    }
} else {
    echo "<tr><td colspan='8' style='text-align:center;'>No medicines found with quantity less than $threshold.</td></tr>";
}
$stmt->close();
?>
        </tbody>
    </table>

    </div>
    </div>
</div>
</section>
</body>
</html>
