<!DOCTYPE html>
<html lang="en">
    <?php include "head.php"; ?>
<body>
    
<!-- includes the menu -->
<?php include "navbar.php"; ?>
    
    <div class="container mt-4 mb-3">
        <div class="row">
            <div class="col-12 mt-4">
                <h3>Lista de Trajes</h3>
            </div>
            <table class="table table-striped" id="listagemTrajes">
                <thead>
                    <tr>
                        <th scope="col">ref</th>
                        <th scope="col">nome</th>
                        <th scope="col">estado</th>
                        <th scope="col">valor</th>
                        <th scope="col">imagem</th>
                        <th scope="col">id_tipo</th>
                        <th scope="col">id_armazem</th>
                        <th scope="col">Remover?</th>
                    </tr>
                </thead>
                <tbody id="listaTrajes"></tbody>
            </table>
        </div>
    </div>
    <?php include "scripts.php"; ?>
</body>
</html>