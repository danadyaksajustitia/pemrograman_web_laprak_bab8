
<?php
$myFile = "testFile.txt";
$fh = fopen($myFile, 'r');

fgets($fh);
$theData = fgets($fh);

fclose($fh);
echo $theData;
?>
