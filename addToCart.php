<?php
session_start();
$p_ID = $_GET['p_ID'];
$_SESSION['cart'] = $_SESSION['cart'] . ' ' . $p_ID;
echo '<html><head></head><body><script> window.history.back(); </script></body></html>'; // header -> location is more efficient, as browser do not need to render html and call js.
?>