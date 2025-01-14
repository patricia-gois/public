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
                <h3>Lista de Eventos</h3>
            </div>
            <table class="table table-striped" id="listagemEventos">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Organizador</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Localidade</th>
                        <th scope="col">Título</th>
                        <th scope="col">Data Início</th>
                        <th scope="col">Data Fim</th>
                        <th scope="col">Facebook</th>
                        <th scope="col">Instagram</th>
                        <th scope="col">Tiktok</th>
                        <th scope="col">Remover?</th>
                    </tr>
                </thead>
                <tbody id="listaEventos"></tbody>
            </table>
        </div>
    </div>
    <?php include "scripts.php"; ?>
</body>
</html>