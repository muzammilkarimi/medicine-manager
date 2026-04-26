<?php

            include 'connection.php';
            $name = $_POST["search"];

            $sql ="select * from add_med WHERE name LIKE '%{$name}%'";

            $query =mysqli_query($con, $sql);
            if(mysqli_num_rows($query)>0){
            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr>
            <td class="change"><?php echo $rows['s.no']; ?></td>
            <td class="py-2"><?php echo $rows['name']; ?></td>
            <td class="py-2"><?php echo $rows['comname']; ?></td>
            <td class="py-2"><?php echo $rows['exp']; ?> </td>
            <td class="py-2">Rs. <?php echo $rows['selling_price']; ?> </td>
            <td class="py-2"><?php echo $rows['total_quantity']; ?> </td>
            <td class="change-img"><a href="edit_medicine.php?id=<?php echo $rows['s.no']; ?>"><img src="img/edit.svg" alt=""></a> <a href="delete_medicine.php?id=<?php echo $rows['s.no']; ?>" onclick="return confirm('Are you sure you want to delete this medicine?');"><img src="img/delete.svg" alt=""></a> </td>
            </tr>
                
        <?php
            }
        }
        else{
        ?>
        <tr><td>0</td><td>This Medicine is not Available..</td></tr>

        <?php    
        }

        ?>