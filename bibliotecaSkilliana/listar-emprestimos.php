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
                <h3>Lista de Empréstimos</h3>
            </div>
            <table class="table table-striped" id="listagemEmprestimos">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Data Registo</th>
                        <th scope="col">Data Entrega Prevista</th>
                        <th scope="col">Livro</th>
                        <th scope="col">Colaborador</th>
                        <th scope="col">Sócio</th>
                        <th scope="col">Remover?</th>
                    </tr>
                </thead>
                <tbody id="listaEmprestimos"></tbody>
            </table>
        </div>
    </div>
    <?php include "scripts.php"; ?>

</body>
</html>