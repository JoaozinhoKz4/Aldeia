<?php
    if (!isset($_SESSION)) session_start();
    if ($_SESSION['UsuarioNivel'] != 3) {
      header ("Location: ../../sistema/login/verifica_sessao.php"); }
      $id_user = $_SESSION['UsuarioID']; 
      require_once('../../sistema/conecta_db.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link id="theme" rel="stylesheet" href="../../../assets/css/themes/theme-blue.css" />
    <link rel="stylesheet" href="../main.css">
    <link rel="shortcut icon" href="../../../assets/img/favicon.png">
    <title>Aldeia Imobiliária</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <a class="navbar-brand">
            Área do Administrador</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
              <li class="nav-item"><a href="../cadastrar-documentos/" class="nav-link active"><i class="fai fa fa-file-archive-o fa-2x" aria-hidden="true"></i>Cadastrar/Administrar Documentos</a></li>
                <li class="nav-item"><a href="#" class="nav-link active"><i class="fai fa fa-file-text-o fa-2x" aria-hidden="true"></i>Visualizar Documentos</a></li>
                <li class="nav-item"><a href="../cadastrar-usuario/#cadastrar-adm" class="nav-link active"><i class="fai fa fa-address-book-o fa-2x" aria-hidden="true"></i>Cadastrar/Excluir Usuários</a></li>
                <li class="nav-item"><a href="../analisar-imovel" class="nav-link active"><i class="fai fa fa-plus fa-2x" aria-hidden="true"></i>Imóveis a analisar</a></li>
                <li class="nav-item"><a href="../../sistema/login/encerra_sessao.php" class="nav-link active"><i class="fai fa fa-sign-out fa-2x" aria-hidden="true"></i>Sair</a></li>              
              </ul>
            </div>
          </nav>
    </header>
    <main>
        <section id="cadastrar-doc">
            <div class="container">
                <div class="col-lg-12 text-center">
                    <h1 class="arq-title">Visualizar Documentos</h1>
                  </div>

                  <div class="col">

                    <div class="list-group thead-dark">

                                

                    <?php
                        $path = "../arquivos/";
                        $diretorio = dir($path);
                        
                        while($arquivo = $diretorio -> read()){
                          if ($arquivo == "." or $arquivo=="..") {
                            continue;
                          }

                        echo '<a href="'.$path.$arquivo.'" class="list-group-item list-group-item-action list-group-item-light" download>'.$arquivo.'</a><br/>';
                        
                      }
                        $diretorio -> close();
                        ?>

                        </div>
                    </div>

                </div>
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
   
</body>
</html>
