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
    $query ="SELECT DISTINCT MONTH(date1) as 'MONTH1' FROM soldticket WHERE fullname1 =   '" . $_POST["id"] . "' ";
   

	$results = $connection->query($query);

?>
	<option value="">Month</option>
<?php

	while($rs=$results->fetch_assoc()) {
		$date1 = date("F", mktime(0, 0, 0,$rs['MONTH1'], 10));
?>
<option value="<?php echo $date1; ?>"><?php echo $date1; ?></option>
	

<?php

}

?>
