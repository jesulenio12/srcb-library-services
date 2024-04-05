<?php
header("Content-type: application/csv");
header("Content-Disposition: attachment;filename=CSVPeriodicalBookTemplate.csv");
header("Pragma: no-cache");
header("Expires: 0");
readfile("CSVPeriodicalBookTemplate.csv");
exit;
?>