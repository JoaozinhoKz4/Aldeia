<?php 
    if (isset($_GET['certo'])) {
        echo '<script>alert("Imóvel enviado para avaliação.")</script>';
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link id="theme" rel="stylesheet" href="../assets/css/themes/theme-blue.css" />
    <link rel="stylesheet" href="../area-do-usuario/administracao/main.css">
    <title>Aldeia Imobiliária</title>
</head>
<body>
    <header id="header" class="header-horizontal dark">
        <nav id="navigation-main" class="module module-nav">
            <div class="module module-back">
                    <a href="../index.php" class="nav-back"><i class="fa fa-angle-left"></i></a>
            </div>
            <a class="navbar-brand">
            <?php

                if (isset($_GET['alugar'])) {
                    $texto = "Alugar meu Imóvel";
                }
                if (isset($_GET['vender'])) {
                    $texto = "Vender meu Imóvel";
                }
                if (isset($_GET['avaliar'])) {
                    $texto = "Avaliar Imóvel";
                }

            
            echo $texto.'</a>'; ?>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                </ul>
            </div>
          </nav>
    </header>
    <main>
    <section id="cadastra-imovel">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                    </div>
                    <div class="col-sm">

                        <form method="POST" action="../area-do-usuario/sistema/cadastros/cadastra-imovel.php" enctype="multipart/form-data">
                            <h1 class="text-center" style="color: white"> <?php

if (isset($_GET['alugar'])) {
    $texto = "Alugar meu Imóvel";
}
if (isset($_GET['vender'])) {
    $texto = "Vender meu Imóvel";
}
if (isset($_GET['avaliar'])) {
    $texto = "Avaliar Imóvel";
}


echo $texto.'</>'; ?>    
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                 </div>
                                <input name="usuario" class="form-control" placeholder="Seu nome" type="text">
                            </div>

                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user-circle-o"></i> </span>
                                 </div>
                                <input name="telefone" class="form-control" placeholder="Telefone para contato" type="text">
                            </div>

                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text icon-senha"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input class="form-control" name="email" placeholder="E-mail" type="text">
                            </div>

                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text icon-senha"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <textarea class="form-control" placeholder="Escreva os detalhes sobre o imóvel, como localização, nº de quartos, etc." name="detalhes" rows="4"></textarea>
                            </div>

                            <h3 class="text-center" style="color: white">Envie uma imagem para ajudar na avaliação</h3>
                            <div class="form-group input-group">
                                <input style="height: 50px;" class="form-control" name="imagem" type="file">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Enviar p/ avaliação  </button>
                            </div> 

                        </form>
                    </div>
                    <div class="col-sm">
                    </div>
                  </div>
            </div>
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
   
</body>
</html>
