<?php

  include "config.php"; // db configuration

  session_start();

  session_unset();

  session_destroy();

  header("$base_url");

?>
