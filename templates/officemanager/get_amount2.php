<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript"></script>
<body>
<?php
//db connection
$connection = mysqli_connect("localhost","root","","ats");

    $query ="SELECT SUM(amount1) as amount_sum  FROM soldticket WHERE MONTHNAME(date1) = '" . $_POST["id"] . "' AND fullname1 != ''  ";
   

	$results = $connection->query($query);
?>
	
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["amount_sum"]; ?>"><?php echo $rs['amount_sum']; ?></option>

<?php

}

?>
</body>
</html>