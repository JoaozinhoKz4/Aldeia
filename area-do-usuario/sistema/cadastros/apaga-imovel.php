<?php

    require_once('../conecta_db.php');

    $id = $_GET['id'];
    $arq = $_GET['arq'];

    $sql = "DELETE FROM `imoveis` WHERE `id_imovel`= $id";
    //echo $sql;

    unlink("../../../$arq");
    $query = mysqli_query($conn, $sql);

    header ("Location: ../../administracao/analisar-imovel");
?>