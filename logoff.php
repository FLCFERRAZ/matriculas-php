<?php
// Apagar o cookie de login.
setcookie("login", null, -1);
// Redirtecionar o uauário para a tela principal do App.
// Como o usuário não está mais autenticado no app,
// Ele será redirecionado para a página de login
<<<<<<< Updated upstream
header("Location: index.php");
=======
header("Location: index.php");
>>>>>>> Stashed changes
