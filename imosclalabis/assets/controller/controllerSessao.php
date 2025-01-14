<?php

require_once '../model/modelSessao.php';

$sessao = new Sessao();

if($_POST['op'] == 1){
    $res = $sessao -> registarSessao($_POST['filme_id'], $_POST['sala_id'], $_POST['data_sessao'], $_POST['hora'], $_POST['estado_id']);
    echo($res);
}else if($_POST['op'] == 2){
    $res = $sessao -> listarSessoes();
    echo($res);
}else if($_POST['op'] == 3){
    $res = $sessao -> removerSessao($_POST['id']);
    echo($res);
}else if($_POST['op'] == 4){
    $res = $sessao -> getInfoSessao($_POST['id']);
    echo($res);
}else if($_POST['op'] == 5){
    $res = $sessao -> gravarEdicaoSessao($_POST['filme_id'], $_POST['sala_id'], $_POST['data_sessao'], $_POST['hora'], $_POST['estado_id'], $_POST['id']);
    echo($res);
}else if($_POST['op'] == 6){
    $res = $sessao -> getFilmeParaSessao();
    echo($res);
}else if($_POST['op'] == 7){
    $res = $sessao -> getSalaParaSessao();
    echo($res);
}else if($_POST['op'] == 8){
    $res = $sessao -> getEstado();
    echo($res);
}else if($_POST['op'] == 9){
    $res = $sessao -> getSessao();
    echo($res);
}


?>