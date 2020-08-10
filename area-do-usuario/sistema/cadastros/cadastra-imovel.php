<?php
require_once('../conecta_db.php');

$usuario = $_POST['usuario'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$detalhes = $_POST['detalhes'];


$arquivo = $_FILES[ 'imagem' ][ 'name' ];
$arquivo_tmp = $_FILES['imagem']['tmp_name'];

$extensao = pathinfo ( $arquivo, PATHINFO_EXTENSION );
$extensao = strtolower ( $extensao );

if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
    $novoNome = $nome.'-'.uniqid ( time () ) . '.' . $extensao;
    $destino = "area-do-usuario/banco-imoveis/".$novoNome; // Substituir embaixo por public_html
    move_uploaded_file( $arquivo_tmp, $_SERVER['DOCUMENT_ROOT']."/public_html"."/".$destino);}
$sql = "INSERT INTO `imoveis`(`id_imovel`, `usuario`, `email`, `detalhes`, `telefone`, `imagem`) VALUES (NULL,'$usuario','$email','$detalhes','$telefone','$destino')";        
//echo $sql;
$query = mysqli_query($conn, $sql);
header("Location: ../../../anunciar-imovel/?certo=1"); 
