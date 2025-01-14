<?php
require_once '../model/modelColaboradores.php';

$colaborador = new Colaborador();

if($_POST['op'] == 1){
    $resposta = $colaborador -> registaColaborador(
        $_POST['nome'], 
        $_POST['morada'], 
        $_POST['telefone'], 
        $_POST['email'], 
        $_POST['numfunc'], 
        $_POST['numcc'], 
        $_POST['datanasc'], 
        $_POST['id_tipo']
    );
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $colaborador -> listaColaboradores();
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $colaborador -> getInfoColaborador(
        $_POST['id']
    );
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $colaborador -> guardaEditColaborador(
        $_POST['id'],
        $_POST['nome'], 
        $_POST['morada'], 
        $_POST['telefone'], 
        $_POST['email'], 
        $_POST['numfunc'], 
        $_POST['numcc'], 
        $_POST['datanasc'], 
        $_POST['id_tipo']);
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $colaborador -> removerColaborador($_POST['id']);
    echo($resposta);
}else if($_POST['op'] == 7){
    $resposta = $colaborador -> getTiposFunc();
    echo($resposta);
}else if($_POST['op'] == 8){
    $resposta = $colaborador -> getColaborador();
    echo($resposta);
}

?>