<?php

// Fechando sessão
session_start();
session_destroy();

// redirecionando para a pagina index
header("Location: login.php");
exit;
?>