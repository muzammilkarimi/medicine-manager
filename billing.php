<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/med_man2.png" />
    <title>Remove-Medicine</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="styles/billing_style.css"> -->
    <style>
        <?php include "styles/billing_style.css" ?>
    </style>
    
</head>

<body>

    <section class="main">
        <?php
         include 'navbar.php'
        ?>
        <section class="form">
        <div class="bill_box">
             <div class="heading">
                <h2>Invoice</h2>
            </div>
            <!-- <form class="details" action="" method="POST">
                <div class="details_two">
               <div class="rmsearch">
                   <p> Customer Name:</p> <input autocomplete="off" id="enter-med" type="text" name="medname" placeholder="Enter Medicine Name"><br>
                   <div style="position: absolute; background-color: white; width:300px; border-radius:15px; overflow:hidden;" id="suggestion-box"></div>
                </div>
               <p> Mobile No:</p> <input id="expdate" type="text" name="exp" placeholder="Expiry Date" required><br>
               <p> Address:</p> <input id="quantity" type="int" name="quan" placeholder="Enter Quantity" required><br>
               <p> Price:</p><div class="calculate" style="display: flex;"> <input style="" id="price" value="" type="int" name="sprice" placeholder="Price" required><br>
               <div class="add-button" style="display: flex; justify-content: center;">
                    <button class="btn" name="getprice">
                        <div class="image">
                            <img src="img/add.svg" alt="">
                        </div>
                        <div class="text">
                            <h2 style="" >Calculate</h2>
                            <p style="margin: 0px; letter-spacing: .8px; font-size: .5rem;">the price</p>
                        </div>
                    </button>
            </div>
               </div>
               <p>  Name:</p> <input type="text" name="cusname" placeholder="Enter Customer Name" required><br>
               <p> Paid/Unpaid:</p> <input type="int" name="p/up" placeholder="Paid or Unpaid" required><br>
               <p> Total Quantity:</p> <input type="int" name="tquan" placeholder="Enter Total Quantity" required> -->
               <!-- </div> -->
            <!-- <div class="add-button" style="display: flex; justify-content: center;">
                    <button class="btn" name="submit">
                        <div class="image">
                            <img src="img/add.svg" alt="">
                        </div>
                        <div class="text">
                            <h2 style="" >Remove</h2>
                            <p style="margin: 0px; letter-spacing: .8px; font-size: .5rem;">Medicine</p>
                        </div>
                    </button>
            </div>
            </form> --> 
        <!-- </div>
    </section>

    </section>
    <script>
    $(document).ready(function(){
        $("#enter-med").keyup(function(){
            $.ajax({
            type: "POST",
            url: "rm-live-search.php",
            data:'keyword='+$(this).val(),
            
            success: function(data){
                $("#suggestion-box").show();
                $("#suggestion-box").html(data);
               
            }
            });
        });
    });
    
    function selectmedicine(medname,medsno,medprice,medquantity) {
    $("#enter-med").val(medname);
    $("#expdate").val(medsno);
    $("#price").val(medprice);
    $("#suggestion-box").hide();
    }
    </script>
</body>

</html>

<?php
    // include 'connection.php';
    // if(isset($_POST['submit'])){
    //     // when press add button we get values through it's name  
    //     $name = $_POST['medname'];
    //     $compname = $_POST['comname'];
    //     $expiry = $_POST['exp'];
    //     $sp = $_POST['sprice'];
    //     $bp = $_POST['bprice'];
    //     $quant = $_POST['quan'];
    //     $tquant = $_POST['tquan'];
    //     date_default_timezone_set('Asia/Kolkata');
    //     $date = date('y-m-d');
    //     $time = date('H:i a');

    //     $insertquery = "insert into add_med(name,comname,exp,selling_price,buying_price,quantity,total_quantity) 
    //      VALUES ('$name','$compname','$expiry','$sp','$bp','$quant','$tquant')";
    //     mysqli_query($con,$insertquery);


    //     $sql = "INSERT INTO `add_history`(`name`,`comname`, `expiry`, `buying_price`, `selling_price`, `quantity`,`date`,`time`) VALUES ('$name','$compname','$expiry',
    //     '$bp','$sp','$tquant','$date','$time')";
    //     $res = mysqli_query($con,$sql);



    //     if($res){
            ?>
         //     <script>
        //         alert("medicine added");
        //     </script>
            <?php 
        // }else{
        //     ?>
        //     <script>
        //         alert("medicine not added");
        //     </script>
        //     <?php
        // }
    // }
?>
