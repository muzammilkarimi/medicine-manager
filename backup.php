<?php
include 'connection.php';

$tables = array();
$result = mysqli_query($con,"SHOW TABLES");
while($row = mysqli_fetch_row($result)){
  $tables[] = $row[0];
}

$return = '';
$return .= "-- Database Backup for med_man\n";
$return .= "-- Generated on " . date('Y-m-d H:i:s') . "\n\n";

foreach($tables as $table){
  $result = mysqli_query($con,"SELECT * FROM `".$table."`");
  $num_fields = mysqli_num_fields($result);
  
  $return .= 'DROP TABLE IF EXISTS `'.$table.'`;';
  $row2 = mysqli_fetch_row(mysqli_query($con,"SHOW CREATE TABLE `".$table."`"));
  $return .= "\n\n".$row2[1].";\n\n";
  
  for($i = 0; $i < $num_fields; $i++){
    while($row = mysqli_fetch_row($result)){
      $return .= "INSERT INTO `".$table."` VALUES(";
      for($j = 0; $j < $num_fields; $j++){
        $row[$j] = addslashes($row[$j]);
        if(isset($row[$j])){ 
            $return .= '"'.$row[$j].'"';
        } else { 
            $return .= 'NULL';
        }
        if($j < ($num_fields - 1)){ 
            $return .= ',';
        }
      }
      $return .= ");\n";
    }
  }
  $return .= "\n\n\n";
}

// Generate the download
$filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . strlen($return));

echo $return;
exit;
?>
