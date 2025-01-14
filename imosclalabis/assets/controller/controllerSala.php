<?php

require_once '../model/modelSala.php';

$sala = new Sala();

if($_POST['op'] == 1){
    $res = $sala -> registarSala($_POST['descricao'], $_POST['cinema_id']);
    echo($res);
}else if($_POST['op'] == 2){
    $res = $sala -> listarSalas();
    echo($res);
}else if($_POST['op'] == 3){
    $res = $sala -> removerSala($_POST['id']);
    echo($res);
}else if($_POST['op'] == 4){
    $res = $sala -> getInfoSala($_POST['id']);
    echo($res);
}else if($_POST['op'] == 5){
    $res = $sala -> gravarEdicaoSala($_POST['descricao'], $_POST['cinema_id'], $_POST['id']);
    echo($res);
}else if($_POST['op'] == 6){
    $res = $sala -> getSala();
    echo($res);
}

?>