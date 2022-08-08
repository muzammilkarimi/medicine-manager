<?php

            include 'connection.php';
            $name = $_POST["search"];

            $sql ="select * from add_history WHERE name LIKE '%{$name}%' or date LIKE '%{$name}%'" ;

            $query =mysqli_query($con, $sql);
            if(mysqli_num_rows($query)>0){
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
        }
        else{
        ?>
        <tr><td>0</td><td>This history is not Available..</td></tr>

        <?php    
        }

        ?>