<?php
if (!function_exists('getmtime'))
{
  function getmtime()
  {
    $a = i18n::explode (' ', microtime());
    return(double) $a[0] + $a[1];
  }
}

  global $StartTime, $SQLCount;
  $loadtime = getmtime() - $StartTime;
  printf("%.3f sec/%d queries", $loadtime, $SQLCount);
?>
