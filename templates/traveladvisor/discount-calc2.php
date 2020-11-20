
<?php

$origNum = $_POST['orignum'];
$toApply = $_POST['toApply'];

echo $origNum && $toApply ? round($origNum + $toApply,2) : 0;
?>