<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>
<!-- includes the menu -->
<?php include "navbar.php"; ?>

    <!-- edit book -->
    <div class="container">
        <div class="row">
            
        <div class="col-12 my-4">
            <h4>Editar Livros</h4>
        </div>
        <div class="col-6 my-3">

        <div class="mb-3">
            <label for="selectLivro" class="form-label">Selecionar Livro:</label>
            <select class="form-select" aria-label="Default select example" id="selectLivro" onchange="getInfoLivro(this.value)"></select>

        </div>

                        <div class="mb-3">
                            <label for="tituloLivroEdit" class="form-label">Título:</label>
                            <input type="text" class="form-control" id="tituloLivroEdit">
                        </div>
                        <div class="mb-3">
                            <label for="isbnLivroEdit" class="form-label">ISBN:</label>
                            <input type="text" class="form-control" id="isbnLivroEdit">
                        </div>
                        <div class="mb-3">
                            <label for="sinopseLivroEdit" class="form-label">Sinopse:</label>
                            <input type="text" class="form-control" id="sinopseLivroEdit">
                        </div>
                        <div class="mb-3">
                            <label for="qtdLivroEdit" class="form-label">Quantidade:</label>
                            <input type="number" class="form-control" id="qtdLivroEdit">
                        </div>
                        <div class="mb-3">
                            <label for="dataLancLivroEdit" class="form-label">Data de Lançamento:</label>
                            <input type="date" class="form-control" id="dataLancLivroEdit">
                        </div>
                        <div class="mb-3">
                            <label for="edicaoLivroEdit" class="form-label">Edição:</label>
                            <input type="text" class="form-control" id="edicaoLivroEdit">
                        </div>
                        <div class="mb-3">
                            <label for="editoraLivroEdit" class="form-label">Editora:</label>
                            <input type="text" class="form-control" id="editoraLivroEdit">
                        </div>
                        <div class="mb-3">
                            <label for="idiomaLivroEdit" class="form-label">Idioma:</label>
                            <input type="text" class="form-control" id="idiomaLivroEdit">
                        </div>
                        <div class="mb-3">
                            <label for="qtdPaginasLivroEdit" class="form-label">Nº de Páginas:</label>
                            <input type="number" class="form-control" id="qtdPaginasLivroEdit">
                        </div>

                        <div class="mb-3">
                            <label for="estadoLivroEdit" class="form-label">Estado:</label>
                            <select class="form-select" aria-label="Default select example" id="estadoLivroEdit">
                                <option value="-1">Selecione uma opção</option>
                                <option value="0">Esgotado</option>
                                <option value="1">Disponível</option>
                            </select>
                            </select>
                        </div>
        
                <button type="button" class="btn btn-primary" id="btnGuardarLivro">Guardar</button>
    </div>

    </div>
</div>


   
</div>
<?php include "scripts.php"; ?>

</body>
</html>