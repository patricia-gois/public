<?php
require_once '../model/modelCliente.php';

$cliente = new Cliente();

if($_POST['op'] == 1){
    $resposta = $cliente -> newClient(
        $_POST['nif'], 
        $_POST['nome'], 
        $_POST['morada'], 
        $_POST['email'], 
        $_POST['telefone'], 
        $_POST['estado']
    );
    echo($resposta);
// }else if ($_POST['op'] == 2) {
//     echo $cliente->getSocios();
// }else if($_POST['op'] == 3){
    $resposta = $cliente -> getInfoClient($_POST['nif']);
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $cliente -> saveEditClient(
        $_POST['nif'],
        $_POST['nome'], 
        $_POST['morada'], 
        $_POST['email'], 
        $_POST['telefone'], 
        $_POST['estado']
    );
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $cliente -> listClients();
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $cliente -> removeClient($_POST['nif']);
    echo($resposta);
}


?>