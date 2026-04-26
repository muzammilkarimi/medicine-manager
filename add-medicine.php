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
        <?php include 'navbar.php' ?>
        <h1 class="page-title">Add Medicine</h1>
        
        <div class="premium-container">
            <div class="premium-box">
                <form action="" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="medname" placeholder="Enter Medicine Name" required>
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="comname" placeholder="Enter Company Name" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Selling Price (Rs)</label>
                            <input type="number" step="any" name="sprice" placeholder="Enter Selling Price" required>
                        </div>
                        <div class="form-group">
                            <label>Buying Price (Rs)</label>
                            <input type="number" step="any" name="bprice" placeholder="Enter Buying Price" required>
                        </div>

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quan" placeholder="Enter Quantity" required>
                        </div>
                        <div class="form-group">
                            <label>Total Quantity</label>
                            <input type="number" name="tquan" placeholder="Enter Total Quantity" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Rack No</label>
                            <input type="text" name="rackno" placeholder="Enter Rack Number" required>
                        </div>
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="date" name="exp" required>
                        </div>

                        <div class="submit-container">
                            <button type="submit" class="premium-btn" name="submit">
                                <img src="img/add.svg" alt="">
                                <span>Add Medicine</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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