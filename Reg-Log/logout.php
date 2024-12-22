<?php
session_start();
session_destroy();
header("Location: Log.php");
exit;
?>
