<?php
  exec("free -mtl", $output);
  print_r($output);
  var_dump()
?>