<?php

require_once '../model/modelCinema.php';

$cinema = new Cinema();

if($_POST['op'] == 1){
    $res = $cinema -> registarCinema($_POST['nome'], $_POST['local_id']);
    echo($res);
}else if($_POST['op'] == 2){
    $res = $cinema -> listarCinemas();
    echo($res);
}else if($_POST['op'] == 3){
    $res = $cinema -> removerCinema($_POST['id']);
    echo($res);
}else if($_POST['op'] == 4){
    $res = $cinema -> getInfoCinema($_POST['id']);
    echo($res);
}else if($_POST['op'] == 5){
    $res = $cinema -> gravarEdicaoCinema($_POST['nome'], $_POST['local_id'], $_POST['id']);
    echo($res);
}else if($_POST['op'] == 6){
    $res = $cinema -> getLocalidade();
    echo($res);
}else if($_POST['op'] == 7){
    $res = $cinema -> getCinema();
    echo($res);
}else if($_POST['op'] == 8){
    $res = $cinema -> registaLocalidade($_POST['descricao']);
    echo($res);
}

?>