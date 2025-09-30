<?php
$login_cookie = $_COOKIE["login"];
if(!isset($login_cookie)) {
    // Usuário não está autenticado pois não possui o cookie de login definido.
    // Redireciona o usuário para a página de login.
    header("Location: login.php");
}