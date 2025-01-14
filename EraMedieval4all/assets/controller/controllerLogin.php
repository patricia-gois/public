<?php

include_once "../model/modelLogin.php";

$log = new Login();

if($_POST['op'] == 1){
    $resp = $log -> registUser($_POST['nome'],$_POST['morada'],$_POST['telefone'],$_POST['email'], $_POST['password'], $_POST['id_tipo']);
    echo($resp);
}else if ($_POST['op'] == 2) {
    $resp = $log -> login($_POST['nome'], $_POST['password']);
    echo($resp);
}else if($_POST['op'] == 3){
    $resp = $log -> logout();
    echo($resp);
}else if($_POST['op'] == 4){
    $resp = $log -> getTypes();
    echo($resp);
}else if($_POST['op'] == 5){
    $resp = $log -> listaLogins();
    echo($resp);
}

?>