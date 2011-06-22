<?php

if (!function_exists('getmtime'))
{
  function getmtime()
  {
    $a = i18n::explode (' ',microtime());
    return(double) $a[0] + $a[1];
  }
}

// For benchmarking
global $StartTime;
$StartTime = getmtime();
?>
