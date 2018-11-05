<?php

$filename = 'Hello.test.World.jpg';

//$exp = basename( $filename);
$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));


//$nof = substr($filename , 0 , -(strlen($exp[count($exp)-1])+1));
echo date("Ymdhisu");

?>