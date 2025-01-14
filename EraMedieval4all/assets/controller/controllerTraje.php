<?php
require_once '../model/modelTraje.php';

$traje = new Traje();

if($_POST['op'] == 1) {
    $resposta = $traje->registTraje(
        $_POST['ref'], 
        $_POST['nome'], 
        $_POST['estado'], 
        $_POST['valor'],
        $_FILES,
        $_POST['id_tipo'], 
        $_POST['id_armazem']
    );
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $traje -> listTrajes();
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $traje -> getInfoTraje($_POST['ref']);
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $traje -> saveEditTraje(
        $_POST['ref'],
        $_POST['nome'], 
        $_POST['estado'], 
        $_POST['valor'], 
        $_FILES, 
        $_POST['id_tipo'], 
        $_POST['id_armazem']
    );
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $traje -> removeTraje($_POST['ref']);
    echo($resposta);
}else if ($_POST['op'] == 7) {
    echo $traje->getTiposTraje();
    echo($resposta);
}else if ($_POST['op'] == 8) {
    echo $traje->getArmazens();
    echo($resposta);
}else if ($_POST['op'] == 11) {
    echo $traje->getTrajes();
    echo($resposta);
}
?>