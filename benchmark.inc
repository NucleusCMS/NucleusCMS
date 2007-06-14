<?php

if (!function_exists('getmtime'))
{
  function getmtime()
  {
    $a = explode (' ',microtime());
    return(double) $a[0] + $a[1];
  }
}

// For benchmarking
global $StartTime, $SQLQCount;
$StartTime = getmtime();
$SQLCount = 0;

?>
