<!DOCTYPE html>
<html lang="en">
    <?php include "head.php"; ?>
<body>
<!-- includes the menu -->
<?php include "navbar.php"; ?>
    
    <!-- Staff list -->

    <div class="container mt-4 mb-3">
        <div class="row">
            <div class="col-12 mt-4">
                <h3>Lista de Sócios</h3>
            </div>
            <table class="table table-striped" id="listagemSocios">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CC</th>
                        <th scope="col">Nº Sócio</th>
                        <th scope="col">Morada</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Remover?</th>
                    </tr>
                </thead>
                <tbody id="listaSocios"></tbody>
            </table>
        </div>
    </div>
    <?php include "scripts.php"; ?>

</body>
</html>