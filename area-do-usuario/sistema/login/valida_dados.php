<?php

    include_once("../conecta_db.php");

    if((isset($_POST['usuario'])) && (isset($_POST['senha']))){
        $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);  //echo '<br>'.$usuario.'<br>';
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        $senha = sha1($senha); //echo '<br>'.$senha.'<br>';
           
    $sql = "SELECT * FROM user WHERE `login` = '$usuario' && ativo=1 && senha = '$senha' LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) != 1) {
        //echo "Login inválido!";
        header("Location: ../../login/index.php?erro=1"); exit;
    } else {
        $resultado = mysqli_fetch_assoc($query);
    
        if (!isset($_SESSION)) session_start();

        $_SESSION['UsuarioID'] = $resultado['id_user'];
        $_SESSION['UsuarioNome'] = $resultado['nome'];
        $_SESSION['UsuarioNivel'] = $resultado['nivel'];

        header("Location: verifica_sessao.php"); exit;
    }
}