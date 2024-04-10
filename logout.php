<?php
$_SESSION = [];

if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), session_id(), time()-36000, '/');
}

session_destroy();
header("Location: index.php");
exit();

?>