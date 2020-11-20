<?php
$origNum = intval($_POST['orignum']);
$toApply = $_POST['toApply'];

 echo $origNum && $toApply ? $origNum - ($origNum * ($toApply/100)): 0;
?>