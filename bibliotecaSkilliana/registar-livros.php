<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>

<body>
<!-- includes the menu -->
<?php include "navbar.php"; ?>

    <!-- Register book  -->
<div class="container">
    <div class="row">
        <div class="col-12 my-4">
            <h4>Registar Livros</h4>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label for="tituloLivro" class="form-label">Título:</label>
                <input type="text" class="form-control" id="tituloLivro">
            </div>
            <div class="mb-3">
                <label for="isbnLivro" class="form-label">ISBN:</label>
                <input type="text" class="form-control" id="isbnLivro">
            </div>
            <div class="mb-3">
                <label for="sinopseLivro" class="form-label">Sinopse:</label>
                <input type="text" class="form-control" id="sinopseLivro">
            </div>
            <div class="mb-3">
                <label for="qtdLivro" class="form-label">Quantidade:</label>
                <input type="number" class="form-control" id="qtdLivro">
            </div>
            <div class="mb-3">
                <label for="dataLancLivro" class="form-label">Data de Lançamento:</label>
                <input type="date" class="form-control" id="dataLancLivro">
            </div>
            <div class="mb-3">
                <label for="edicaoLivro" class="form-label">Edição:</label>
                <input type="text" class="form-control" id="edicaoLivro">
            </div>
            <div class="mb-3">
                <label for="editoraLivro" class="form-label">Editora:</label>
                <input type="text" class="form-control" id="editoraLivro">
            </div>
            <div class="mb-3">
                <label for="idiomaLivro" class="form-label">Idioma:</label>
                <input type="text" class="form-control" id="idiomaLivro">
            </div>
            <div class="mb-3">
                <label for="qtdPaginasLivro" class="form-label">Nº de Páginas:</label>
                <input type="number" class="form-control" id="qtdPaginasLivro">
            </div>

            <div class="mb-3">
                <label for="estadoLivro" class="form-label">Estado:</label>
                <select class="form-select" aria-label="Default select example" id="estadoLivro">
                    <option value="-1">Selecione uma opção</option>
                    <option value="0">Esgotado</option>
                    <option value="1">Disponível</option>
                </select>
            </div>

            <button type="button" class="btn btn-dark" onclick="registaLivro()">Guardar</button>
        </div>
    </div>
    <br><br>

   
</div>
<?php include "scripts.php" ?>

</body>
</html>