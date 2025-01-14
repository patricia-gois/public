<?php

require_once '../model/modelFilme.php';

$filme = new Filme();

if($_POST['op'] == 1){
    $res = $filme -> registarFilme($_POST['nome'], $_POST['ano'], $_POST['descricao'], $_POST['tipo_filme_id']);
    echo($res);
}else if($_POST['op'] == 2){
    $res = $filme -> listarFilmes();
    echo($res);
}else if($_POST['op'] == 3){
    $res = $filme -> removerFilme($_POST['id']);
    echo($res);
}else if($_POST['op'] == 4){
    $res = $filme -> getInfoFilme($_POST['id']);
    echo($res);
}else if($_POST['op'] == 5){
    $res = $filme -> gravarEdicaoFilme($_POST['nome'], $_POST['ano'], $_POST['descricao'], $_POST['tipo_filme_id'], $_POST['id']);
    echo($res);
}else if($_POST['op'] == 6){
    $res = $filme -> getTipoFilme();
    echo($res);
}
else if($_POST['op'] == 7){
    $res = $filme -> getFilme();
    echo($res);
}


?>