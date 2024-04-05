<?php
header("Content-type: application/csv");
header("Content-Disposition: attachment;filename=CSVBookTemplate.csv");
header("Pragma: no-cache");
header("Expires: 0");
readfile("CSVBookTemplate.csv");
exit;
?>