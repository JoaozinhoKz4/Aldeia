<?php
  if (!isset($_SESSION)) session_start();
    
  if ($_SESSION['UsuarioNivel'] == 3) {
      header("Location: ../../administracao/cadastrar-documentos/"); exit;
  }
  else if  ($_SESSION['UsuarioNivel'] == 2 || $_SESSION['UsuarioNivel'] == 1){
      header("Location: ../../documentos");exit;
  }
  else {
      header("Location: ../../login");exit;
  }


  ?>