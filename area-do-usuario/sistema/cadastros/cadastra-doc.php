<?php
require_once('../conecta_db.php');

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$envio = date('Y-m-d H:i:s');
$code = $_POST['code'];

$arquivo = $_FILES[ 'arquivo' ][ 'name' ];
$arquivo_tmp = $_FILES['arquivo']['tmp_name'];

$extensao = pathinfo ( $arquivo, PATHINFO_EXTENSION );
$extensao = strtolower ( $extensao );

if ( strstr ( '.docx;.txt;.pdf;.xlsm;.csv;.jpg;.jpeg;.gif;.png', $extensao ) ) {
    $novoNome = $nome.'-'.uniqid ( time () ) . '.' . $extensao;
    $destino = "area-do-usuario/administracao/arquivos/".$novoNome;
    move_uploaded_file( $arquivo_tmp, $_SERVER['DOCUMENT_ROOT']."/public_html"."/".$destino);
}

$sql = "INSERT INTO `docs`(`id_doc`, `titulo`, `nome`, `descricao`, `envio`, `code`) VALUES (NULL,'$nome','$destino','$descricao','$envio',$code)";
$query = mysqli_query($conn, $sql);
header("Location: ../../administracao/cadastrar-documentos/"); 
