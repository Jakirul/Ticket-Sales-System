<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript"></script>
<body>
<?php
//connection to db
$connection = mysqli_connect("localhost","root","","ats");
	//selects id and amount from soldticket
    $query ="SELECT id,amount1 FROM soldticket WHERE id =   '" . $_POST["id"] . "'";
   

	$results = $connection->query($query);
?>
	
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["amount1"]; ?>"><?php echo $rs['amount1']; ?></option>
	<input type = "hidden" name="custid" value="<?php echo $rs['id']; ?>">
<?php

}

?>
</body>
</html>