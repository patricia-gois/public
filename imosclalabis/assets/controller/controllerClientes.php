<?php

require_once '../model/modelCliente.php';

$cliente = new Cliente();

if($_POST['op'] == 1){
    $res = $cliente -> registaCliente($_POST['nif'], $_POST['nome']);
    echo($res);
}else if($_POST['op'] == 2){
    $res = $cliente -> listaClientes();
    echo($res);
}else if($_POST['op'] == 3){
    $res = $cliente -> removeClientes($_POST['nif']);
    echo($res);
}else if($_POST['op'] == 4){
    $res = $cliente -> getCliente($_POST['nif']);
    echo($res);
}else if($_POST['op'] == 5){
    $res = $cliente -> gravarEdicaoCliente($_POST['nome'], $_POST['email'], $_POST['nif']);
    echo($res);
}else if($_POST['op'] == 6){
    $res = $cliente -> getLocalidade($_POST['id'], $_POST['descricao']);
    echo($res);
}

?>