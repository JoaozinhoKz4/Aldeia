<?php

    require_once('../conecta_db.php');
    if (!isset($_SESSION)) session_start();
    
    $nome =  $_POST['nome'];
    $login =  $_POST['login'];
    $nivel =  $_POST['nivel'];
    $senha =  $_POST['senha'];
    $senha = SHA1($senha);

    $sql = "INSERT INTO `user`(`id_user`, `nome`, `login`, `senha`, `ativo`, `nivel`) VALUES (NULL,'$nome','$login','$senha',1,$nivel)";
    //echo $sql;
    $query = mysqli_query($conn, $sql);

    header("Location: ../../administracao/cadastrar-usuario/");

    ?>
