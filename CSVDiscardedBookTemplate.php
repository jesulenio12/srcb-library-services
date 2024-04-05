<?php
header("Content-type: application/csv");
header("Content-Disposition: attachment;filename=CSVDiscardedBookTemplate.csv");
header("Pragma: no-cache");
header("Expires: 0");
readfile("CSVDiscardedBookTemplate.csv");
exit;
?>