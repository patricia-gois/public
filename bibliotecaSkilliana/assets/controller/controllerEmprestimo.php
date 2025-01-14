<?php
require_once '../model/modelEmprestimo.php';

$emprestimo = new Emprestimo();

if($_POST['op'] == 1){
    $resposta = $emprestimo -> registaEmprestimo($_POST['id_livro'], $_POST['data_registo'], $_POST['data_entrega'], $_POST['id_utilizador'], $_POST['id_socio']);
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $emprestimo -> getLivro();
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $emprestimo -> listaEmprestimos();
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $emprestimo -> removerEmprestimo($_POST['id']);
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $emprestimo -> getEmprestimo();
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $emprestimo -> getInfoEmprestimo($_POST['id']);
    echo($resposta);
}

?>