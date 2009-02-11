<?php
if (!function_exists('getmtime'))
{
  function getmtime()
  {
    $a = explode (' ', microtime());
    return(double) $a[0] + $a[1];
  }
}

  global $StartTime, $SQLCount;
  $loadtime = getmtime() - $StartTime;
  printf("%.3f 秒/%d クエリ", $loadtime, $SQLCount);
?>
