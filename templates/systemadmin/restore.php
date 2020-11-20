<?php
//db connection
$connection = mysqli_connect('localhost','root','','ats');
//retrieves db connection from the backup.sql file
$filename = 'backup.sql';
$handle = fopen($filename,"r+");
$contents = fread($handle,filesize($filename));
$sql = explode(';',$contents);
foreach($sql as $query){
  $result = mysqli_query($connection,$query);
  if($result){
    header('Location: database.php');
  }
}
fclose($handle);
header('Location: database.php');
?>