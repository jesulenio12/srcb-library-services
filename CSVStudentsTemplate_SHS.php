<?php
header("Content-type: application/csv");
header("Content-Disposition: attachment;filename=CSVStudentsTemplate_SHS.csv");
header("Pragma: no-cache");
header("Expires: 0");
readfile("CSVStudentsTemplate_SHS.csv");
exit;
?>