<?php

    require_once('../conecta_db.php');
    if (!isset($_SESSION)) session_start();
    
    $id = $_POST['id'];
    $nome =  $_POST['nome'];
    $login =  $_POST['login'];
    $senha =  $_POST['senha'];
    $senha = SHA1($senha);

    $sql = "UPDATE `user` SET `nome`='$nome',`login`='$login',`senha`='$senha' WHERE `id_user`= $id";
    
    //echo $sql;
    $query = mysqli_query($conn, $sql);

    header("Location: ../../dados");

    ?>
