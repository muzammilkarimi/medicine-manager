<style>
    li:hover{
        background-color:red;
    }
    a{
        text-decoration:none;
        color:black;
    }
    a:hover{
        color:red;
    }
</style>
<?php
include 'connection.php';
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM add_med WHERE name like '" . $_POST["keyword"] . "%' ORDER BY name LIMIT 0,6";
$result = mysqli_query($con, $query);
if(!empty($result)) {
?>
<ul style="margin:10px; padding:0;">
<?php
foreach($result as $add_med) {
?>
<a href="#"><li style="list-style:none; cursor:pointer; background-color:white; padding-bottom: 2px;
    letter-spacing: 1px; font-size: 1.1rem; " onClick="selectmedicine('<?php echo $add_med["name"]; ?>',
    '<?php echo $add_med["exp"]; ?>',
    '<?php echo $add_med["selling_price"]; ?>',
    '<?php echo $add_med["quantity"]; ?>');"><?php echo $add_med["name"]; ?></li></a>
<?php } ?>
<script>
    
</script>
</ul>
<?php } } ?>
