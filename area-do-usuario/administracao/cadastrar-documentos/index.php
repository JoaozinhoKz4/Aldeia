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
              <li class="nav-item"><a href="#cadastrar-doc" class="nav-link active"><i class="fai fa fa-file-archive-o fa-2x" aria-hidden="true"></i>Cadastrar/Administrar Documentos</a></li>
                <li class="nav-item"><a href="../visualizar-documentos/" class="nav-link active"><i class="fai fa fa-file-text-o fa-2x" aria-hidden="true"></i>Visualizar Documentos</a></li>
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
                    <h1 class="arq-title">Documentos</h1>
                  </div>

                  <form method="POST" action="../../sistema/cadastros/cadastra-doc.php" enctype="multipart/form-data">
                    <input type="file" class="form-control col-md-6 offset-md-3 input-file" name="arquivo"><br>
                    <input type="text" placeholder="Título" class="form-control col-md-6 offset-md-3" name="nome"><br>
                    <textarea  rows="3" placeholder="Descrição" class="form-control col-md-6 offset-md-3" name="descricao"></textarea> <br>
                    <select class="form-control col-md-6 offset-md-3" name="code">
                        <option value="1" selected>Selecione o usuário</option>

                        <?php
                            $sql = "SELECT * FROM `user` WHERE 1";
                            $resultado = mysqli_query($conn, $sql);
                            if($resultado){
                                while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

                                $id_usuario = $registros['id_user'];
                                $nome = $registros['nome'];

                                echo '<option value="'.$id_usuario.'">'.$nome.'</option>';
                                }
                            }              
                            ?>
                        </select><br>
                        <button type="submit" class="btn btn-primary btn-block col-md-4 offset-md-4"> Cadastrar  </button>
                </form>

                </div>
        </section>
        <section id="admin-doc">
            <div class="container">
                <div class="row">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr class="thead-dark">
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Registro</th>
                            <th>Código</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                        <tbody>

                        <?php
                            $sql = "SELECT * FROM `docs` WHERE 1";
                            $resultado = mysqli_query($conn, $sql);
                            if($resultado){
                                while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

                                $id_doc = $registros['id_doc'];
                                $titulo = $registros['titulo'];
                                $destino = $registros['nome'];
                                $descricao = $registros['descricao'];
                                $registro = $registros['envio'];
                                $code = $registros['code'];

                                echo '<tr class="table-light">';
                                echo '<td><h6>'.$titulo.'</h6></td>';
                                echo '<td>'.$descricao.'</td>';
                                echo '<td>'.$registro.'</td>';
                                echo '<td>'.$code.'</td>';
                                echo '<td><a href="../../sistema/cadastros/apaga-doc.php?id='.$id_doc.'&arq='.$destino.'" class="btn btn-danger" onclick="return confirm(`Tem certeza que deseja excluir este documento?`)"><i class="fa fa-trash fa-2x"></i></a></td>';
                                echo '</tr>';
                                }
                            }              
                            ?>

                        </tbody>
                    </table>
                    </div>
                </div>
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
   
</body>
</html>

    <!--header id="header" class="header-horizontal dark">
        <nav id="navigation-main" class="module module-nav">
            <ul class="nav nav-main-horizontal">
                <li><a href="#home"><i class="fa fa-home fa-2x" aria-hidden="true"></i>Início</a></li>
                <li><a href="#flats"><i class="fa fa-address-book-o fa-2x" aria-hidden="true"></i>Cadastrar Administrador</a></li>
                <li><a href="#gallery"><i class="fa fa-file-archive-o fa-2x" aria-hidden="true"></i>Cadastrar Documento</a></li>
                <li><a href="#gallery"><i class="fa fa-folder-o fa-2x" aria-hidden="true"></i>Administrar Documentos</a></li>
                <li><a href="#gallery"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>Sair</a></li>
                
            </ul>
            <div class="selector"></div>
        </nav>
    </header-->