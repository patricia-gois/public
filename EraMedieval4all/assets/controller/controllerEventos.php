<?php
require_once '../model/modelEventos.php';

$evento = new Evento();

if($_POST['op'] == 1) {
    $resposta = $evento->registaEvento(
        $_POST['id_organizador'], 
        $_POST['descricao'], 
        $_POST['localidade'], 
        $_POST['titulo'], 
        $_POST['data_inicio'], 
        $_POST['data_fim'], 
        $_POST['facebook'], 
        $_POST['instagram'], 
        $_POST['tiktok']
    );
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $evento -> listaEventos();
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $evento -> getInfoEvento($_POST['id']);
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $evento -> guardaEditEvento(
        $_POST['id'],
        $_POST['id_organizador'], 
        $_POST['descricao'], 
        $_POST['localidade'], 
        $_POST['titulo'], 
        $_POST['data_inicio'], 
        $_POST['data_fim'], 
        $_POST['facebook'], 
        $_POST['instagram'], 
        $_POST['tiktok']
    );
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $evento -> removerEvento($_POST['id']);
    echo($resposta);
}else if ($_POST['op'] == 9) {
    echo $evento->getOrganizadores();
}else if ($_POST['op'] == 10) {
    echo $evento->getEventos();
}


?>