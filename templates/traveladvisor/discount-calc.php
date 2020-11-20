
<?php
$amount = $_POST['amount'];
$origNum = $_POST['orignum'];
$toApply = $_POST['toApply'];

echo $amount && $origNum && $toApply ? round($amount / ($origNum * $toApply),2) : 0;
?>