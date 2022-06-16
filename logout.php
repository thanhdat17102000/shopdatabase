<?php
     session_destroy();
     setcookie('user', json_encode($result, JSON_UNESCAPED_UNICODE), time() - 3600 * 24 * 30);
     header("Location: index.php")
?>