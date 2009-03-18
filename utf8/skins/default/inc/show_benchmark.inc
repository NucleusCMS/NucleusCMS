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
  $var = mb_convert_encoding("%.3f 秒/%d クエリ", _CHARSET, 'UTF-8');
  printf($var, $loadtime, $SQLCount);
?>
