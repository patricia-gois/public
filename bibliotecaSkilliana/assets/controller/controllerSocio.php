<?php
require_once '../model/modelSocio.php';

$socio = new Socio();

if($_POST['op'] == 1){
    $resposta = $socio -> registaSocio(
        $_POST['nome'], 
        $_POST['cc'], 
        $_POST['numsocio'], 
        $_POST['morada'], 
        $_POST['email'], 
        $_POST['telefone'], 
        $_POST['datanasc'],
        $_POST['estado']);
    echo($resposta);
}else if ($_POST['op'] == 2) {
    echo $socio->getSocios();
}else if($_POST['op'] == 3){
    $resposta = $socio -> getInfoSocio($_POST['id']);
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $socio -> guardaEditSocio(
        $_POST['id'],
        $_POST['nome'], 
        $_POST['cc'], 
        $_POST['numsocio'], 
        $_POST['morada'], 
        $_POST['email'], 
        $_POST['telefone'], 
        $_POST['datanasc'], 
        $_POST['estado']
    );
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $socio -> listaSocios();
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $socio -> removerSocio($_POST['id']);
    echo($resposta);
}


?>