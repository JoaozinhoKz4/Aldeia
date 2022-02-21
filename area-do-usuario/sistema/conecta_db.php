<?php
    $servidor = "localhost";
    $usuario = "u483503649_admin";
    $senha = "q9N@8nM8";
    $dbname = "u483503649_imob";    

    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    if(!$conn){
        die("Falha na conexao: " . mysqli_connect_error());
    }else{
        //echo "Conexao realizada com sucesso";
    }      
?> 
