<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/med_man2.png" />
    <title>Edit-Medicine</title>
    <style>
  <?php include "styles/style.css" ?>
  
</style>
    
</head>

<body>

    <section class="main">
        <?php
         include 'navbar.php';
         include 'connection.php';

         $id = $_GET['id'] ?? null;
         if (!$id) {
             echo "<script>alert('Invalid Medicine ID'); window.location.href='show.php';</script>";
             exit;
         }

         // Fetch existing data
         $stmt = $con->prepare("SELECT * FROM add_med WHERE `s.no` = ?");
         $stmt->bind_param("i", $id);
         $stmt->execute();
         $result = $stmt->get_result();
         if ($result->num_rows === 0) {
             echo "<script>alert('Medicine not found'); window.location.href='show.php';</script>";
             exit;
         }
         $medicine = $result->fetch_assoc();
         $stmt->close();
        ?>
        <h1 class="page-title">Edit Medicine</h1>
        <div class="premium-container">
            <div class="premium-box">
                <form action="" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="medname" value="<?php echo htmlspecialchars($medicine['name']); ?>" placeholder="Enter Medicine Name" required>
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="comname" value="<?php echo htmlspecialchars($medicine['comname']); ?>" placeholder="Enter Company Name" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Selling Price (Rs)</label>
                            <input type="number" step="any" name="sprice" value="<?php echo htmlspecialchars($medicine['selling_price']); ?>" placeholder="Enter Selling Price" required>
                        </div>
                        <div class="form-group">
                            <label>Buying Price (Rs)</label>
                            <input type="number" step="any" name="bprice" value="<?php echo htmlspecialchars($medicine['buying_price']); ?>" placeholder="Enter Buying Price" required>
                        </div>

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quan" value="<?php echo htmlspecialchars($medicine['quantity']); ?>" placeholder="Enter Quantity" required>
                        </div>
                        <div class="form-group">
                            <label>Total Quantity</label>
                            <input type="number" name="tquan" value="<?php echo htmlspecialchars($medicine['total_quantity']); ?>" placeholder="Enter Total Quantity" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Rack No</label>
                            <input type="text" name="rackno" value="<?php echo htmlspecialchars($medicine['Rack']); ?>" placeholder="Enter Rack Number" required>
                        </div>
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="date" name="exp" value="<?php echo htmlspecialchars($medicine['exp']); ?>" required>
                        </div>

                        <div class="submit-container">
                            <button type="submit" class="premium-btn" name="update">
                                <img src="img/edit.svg" alt="">
                                <span>Update Medicine</span>
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
    if(isset($_POST['update'])){
        $name = $_POST['medname'];
        $compname = $_POST['comname'];
        $rack = $_POST['rackno'];
        $expiry = $_POST['exp'];
        $sp = $_POST['sprice'];
        $bp = $_POST['bprice'];
        $quant = $_POST['quan'];
        $tquant = $_POST['tquan'];

        $updatequery = "UPDATE add_med SET name=?, comname=?, Rack=?, exp=?, selling_price=?, buying_price=?, quantity=?, total_quantity=? WHERE `s.no`=?";
        $stmt = $con->prepare($updatequery);
        $stmt->bind_param("ssssddiii", $name, $compname, $rack, $expiry, $sp, $bp, $quant, $tquant, $id);
        
        if($stmt->execute()){
            ?>
            <script>
                alert("Medicine updated successfully");
                window.location.href = "show.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("Failed to update medicine");
            </script>
            <?php
        }
        $stmt->close();
    }
?>
