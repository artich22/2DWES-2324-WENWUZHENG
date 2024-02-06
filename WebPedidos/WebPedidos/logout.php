<?php
$cookie_nombreee = "usuario";
$cookie_nombre = "admin";

if(isset($_COOKIE[$cookie_nombreee])) {
    setcookie("usuario", "", time() - 3600, "/");
} elseif(isset($_COOKIE[$cookie_nombre])) {
    setcookie("admin", "", time() - 3600, "/");
}
header('Location: pe_login.php');
session_unset();
exit();
?>
