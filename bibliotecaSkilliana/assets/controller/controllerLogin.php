<?php

include_once "../model/modelLogin.php";

$log = new Login();

if($_POST['op'] == 1){
    $resp = $log -> registaUser(
        $_POST['username'], 
        $_POST['pw'], 
        $_POST['pergunta'], 
        $_POST['resposta'], 
        $_POST['id_tipo']
    );
    echo($resp);
}else if($_POST['op'] == 2){
    $resp = $log -> login(
        $_POST['username'], 
        $_POST['pw']
    );
    echo($resp);
}else if($_POST['op'] == 3){
    $resp = $log -> logout();
    echo($resp);
}else if($_POST['op'] == 4){
    $resp = $log -> getTipos();
    echo($resp);
}

?>