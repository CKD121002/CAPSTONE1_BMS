<?php
session_start();
session_destroy();
header("Location: /BMS/index.php");
?>