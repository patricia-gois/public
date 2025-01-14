<?php
require_once '../model/modelLivro.php';

$livro = new Livro();

if($_POST['op'] == 1) {
    $resposta = $livro->registaLivro(
        $_POST['titulo'], 
        $_POST['isbn'], 
        $_POST['sinopse'], 
        $_POST['qtd'], 
        $_POST['datalanc'], 
        $_POST['edicao'], 
        $_POST['editora'], 
        $_POST['idioma'], 
        $_POST['qtdpaginas'], 
        $_POST['estado']
    );
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $livro -> listaLivros();
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $livro -> getInfoLivro($_POST['id']);
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $livro -> guardaEditLivro($_POST['id'],$_POST['titulo'], $_POST['isbn'], $_POST['sinopse'], $_POST['qtd'], $_POST['datalanc'], $_POST['edicao'], $_POST['editora'], $_POST['idioma'], $_POST['qtdpaginas'], $_POST['estado']);
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $livro -> removerLivro($_POST['id']);
    echo($resposta);
}else if($_POST['op'] == 7){
    $resposta = $livro -> getLivroGeneros($_POST['id'], $_POST['livroo_id'], $_POST['genero_id']);
    echo($resposta);
}else if($_POST['op'] == 8){
    $resposta = $livro -> getLivroEstanteSeccao($_POST['id'], $_POST['livrolocal_id'], $_POST['estante_id'], $_POST['seccao_id'], $_POST['qtd']);
    echo($resposta);
}else if ($_POST['op'] == 9) {
    echo $livro->listaLivrosDropdown();
}


?>