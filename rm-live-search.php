<style>
    .suggestion-item {
        list-style: none;
        cursor: pointer;
        background-color: white;
        padding: 10px 15px;
        letter-spacing: 1px;
        font-size: 1.1rem;
        border-bottom: 1px solid #eee;
        color: #333;
        transition: background-color 0.2s;
    }
    .suggestion-item:hover, .suggestion-active {
        background-color: #e6f2ff !important;
        color: rgb(17, 84, 146) !important;
        font-weight: bold;
    }
</style>
<?php
include 'connection.php';
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM add_med WHERE name like '" . $_POST["keyword"] . "%' ORDER BY name LIMIT 0,6";
$result = mysqli_query($con, $query);
if(!empty($result)) {
?>
<ul style="margin:0; padding:0; list-style:none;">
<?php
foreach($result as $add_med) {
?>
<li class="suggestion-item" onClick="selectmedicine('<?php echo $add_med['s.no']; ?>',
    '<?php echo addslashes($add_med['name']); ?>',
    '<?php echo $add_med['selling_price']; ?>',
    '<?php echo $add_med['total_quantity']; ?>');"><?php echo $add_med["name"]; ?> (Stock: <?php echo $add_med['total_quantity']; ?>)</li>
<?php } ?>
</ul>
<?php } } ?>
