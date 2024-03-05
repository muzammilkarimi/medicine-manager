<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/med_man2.png" />
    <title>Add-Medicine</title>
    <style>
  <?php include "styles/style.css" ?>
  
</style>
    
</head>

<body>

    <section class="main">
        <?php
         include 'navbar.php'
        ?>
        <section class="form">
        <div class="box">
            <div class="heading">
                <h2>add medicine</h2>
            </div>
            <form class="details" action="" method="POST">
                <div class="details_two">
               <p> Name:</p> <input type="text" name="medname" placeholder="Enter Medicine Name" required><br>
               <p> Company Name:</p> <input type="text" name="comname" placeholder="Enter Company Name" required><br>
               <p> Rack No:</p> <input type="text" name="rackno" placeholder="Enter Rack Number" required><br>
               <p> Exp. Date:</p> <input type="date" name="exp" placeholder="Enter Expiry Date" required><br>
               <p> Selling Price:</p> <input type="int" name="sprice" placeholder="Enter Selling Price" required><br>
               <p> Buying Price:</p> <input type="int" name="bprice" placeholder="Enter Buying Price" required><br>
               <p> Quantity:</p> <input type="int" name="quan" placeholder="Enter Quantity" required><br>
               <p> Total Quantity:</p> <input type="int" name="tquan" placeholder="Enter Total Quantity" required>
               </div>
            <div class="add-button" style="display: flex; justify-content: center;">
                    <button class="btn" name="submit">
                        <div class="image">
                            <img src="img/add.svg" alt="">
                        </div>
                        <div class="text">
                            <h2 style="" >add</h2>
                            <p style="margin: 0px; letter-spacing: .8px; font-size: .5rem;">Medicine</p>
                        </div>
                    </button>
            </div>
            </form>
        </div>
    </section>

    </section>
</body>

</html>

<?php
    include 'connection.php';
    

    if(isset($_POST['submit'])){
        // when press add button we get values through it's name  
        $name = $_POST['medname'];
        $compname = $_POST['comname'];
        $rack = $_POST['rackno'];
        $expiry = $_POST['exp'];
        $sp = $_POST['sprice'];
        $bp = $_POST['bprice'];
        $quant = $_POST['quan'];
        $tquant = $_POST['tquan'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('y-m-d');
        $time = date('H:i a');

        $insertquery = "insert into add_med(name,comname,Rack,exp,selling_price,buying_price,quantity,total_quantity) 
         VALUES ('$name','$compname','$rack','$expiry','$sp','$bp','$quant','$tquant')";
        mysqli_query($con,$insertquery);


        $sql = "INSERT INTO `add_history`(`name`,`comname`, `expiry`, `buying_price`, `selling_price`, `quantity`,`date`,`time`) VALUES ('$name','$compname','$expiry',
        '$bp','$sp','$tquant','$date','$time')";
        $res = mysqli_query($con,$sql);



        if($res){
            ?>
            <script>
                alert("medicine added");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("medicine not added");
            </script>
            <?php
        }
    }
?>