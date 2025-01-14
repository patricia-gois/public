<?php

require_once '../model/modelSessao.php';

$sessao = new Sessao();

if($_POST['op'] == 1){
    $res = $sessao -> registarSessao($_POST['filme_id'], $_POST['sala_sessao'], $_POST['data_sessao'], $_POST['hora'], $_POST['estado_id']);
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
    $res = $sessao -> gravarEdicaoSessao($_POST['nome'], $_POST['ano'], $_POST['descricao'], $_POST['tipo_filme_id'], $_POST['id']);
    echo($res);
}else if($_POST['op'] == 6){
    $res = $sessao -> getFilmeSessao();
    echo($res);
}
else if($_POST['op'] == 7){
    $res = $sessao -> getSessao();
    echo($res);
}


?>