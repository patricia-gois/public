<!DOCTYPE html>
<html lang="en">
    <?php include "head.php"; ?>
<body>
    
<!-- includes the menu -->
<?php include "navbar.php"; ?>
    
    <!-- book list -->

    <div class="container mt-4 mb-3">
        <div class="row">
            <div class="col-12 mt-4">
                <h3>Lista de Livros</h3>
            </div>
            <table class="table table-striped" id="listagemLivros">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Sinopse</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Lançamento</th>
                        <th scope="col">Edição</th>
                        <th scope="col">Editora</th>
                        <th scope="col">Idioma</th>
                        <th scope="col">Páginas</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Remover?</th>
                    </tr>
                </thead>
                <tbody id="listaLivros"></tbody>
            </table>
        </div>
    </div>
    <?php include "scripts.php"; ?>
</body>
</html>