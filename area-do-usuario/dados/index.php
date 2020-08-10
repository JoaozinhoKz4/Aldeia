<?php
    if (!isset($_SESSION)) session_start();
    if ($_SESSION['UsuarioNivel'] > 0 && $_SESSION['UsuarioNivel'] < 4) {
       }
       else {
        header ("Location: ../sistema/login/verifica_sessao.php");
       }
      $id_user = $_SESSION['UsuarioID']; 
      require_once('../sistema/conecta_db.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link id="theme" rel="stylesheet" href="../../assets/css/themes/theme-blue.css" />
    <link rel="stylesheet" href="../administracao/main.css">
    <link rel="shortcut icon" href="../../assets/img/favicon.png">
    <title>Aldeia Imobiliária</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <a class="navbar-brand">
            Área do Usuário, bem vindo(a) <?php echo $_SESSION['UsuarioNome']; ?></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item"><a href="../documentos/#visualiza" class="nav-link active"><i class="fai fa fa-file-text-o fa-2x" aria-hidden="true"></i>Visualizar Documentos</a></li>
                <li class="nav-item"><a href="#edita-user" class="nav-link active"><i class="fai fa fa-address-book-o fa-2x" aria-hidden="true"></i>Editar dados</a></li>
                <li class="nav-item"><a href="../sistema/login/encerra_sessao.php" class="nav-link active"><i class="fai fa fa-sign-out fa-2x" aria-hidden="true"></i>Sair</a></li>              
              </ul>
            </div>
          </nav>
    </header>
    <main>
    <section id="edita-user">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                    </div>
                    <div class="col-sm">
                    <?php
                            $sql = "SELECT * FROM `user` WHERE `id_user` = $id_user";
                            $resultado = mysqli_query($conn, $sql);
                            if($resultado){
                                while($registros = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

                                $id_usuario = $registros['id_user'];
                                $nome = $registros['nome'];
                                $login = $registros['login'];

                                }
                            }              
                            ?>
                        <form method="POST" action="../sistema/cadastros/edita-user.php">
                            <h1 class="text-center" style="color: white">Editar Usuário</h1>    
                            <input type="hidden" value="<?php echo $id_usuario; ?>" name="id">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                 </div>
                                <input name="nome" class="form-control" placeholder="Nome" type="text" value="<?php echo $nome; ?>">
                            </div>

                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user-circle-o"></i> </span>
                                 </div>
                                <input name="login" class="form-control" placeholder="Login" type="text" value="<?php echo $login; ?>">
                            </div>

                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text icon-senha"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" id="senha1" placeholder="Senha" type="password">
                            </div>

                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text icon-senha"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" id="senha2" placeholder="Confirme a senha" type="password" name="senha">
                            </div>

                            <div class="form-group">
                                <button type="submit" onclick="return verifica()" class="btn btn-primary btn-block"> Cadastrar  </button>
                            </div> 

                        </form>
                    </div>
                    <div class="col-sm">
                    </div>
                  </div>
            </div>
        </section>

    </main>
    <script>
        function verifica() {
          var senha2 = document.getElementById("senha2").value;
          var senha1 = document.getElementById("senha1").value;
    
          if (senha1 != senha2 || senha1=="" || senha2=="") {
            var txt = document.getElementsByClassName("icon-senha");
              txt[0].style.color = "red";
              txt[1].style.color = "red";
              return false;
          }
        }
    
      </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
   
</body>
</html>
