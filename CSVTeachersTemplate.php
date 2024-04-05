<?php
header("Content-type: application/csv");
header("Content-Disposition: attachment;filename=CSVTeachersTemplate.csv");
header("Pragma: no-cache");
header("Expires: 0");
readfile("CSVTeachersTemplate.csv");
exit;
?>