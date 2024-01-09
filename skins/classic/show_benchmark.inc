<?php
  printf("%.3f sec/%d queries", microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], $SQLCount);
