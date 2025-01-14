<!DOCTYPE html>
<html lang="en">
    <?php include "head.php"; ?>
<body>
<?php include "navbar.php"; ?>

    <!-- logins list -->

    <div class="container mt-4 mb-3">
        <div class="row">
            <div class="col-12 mt-4">
                <h3>Lista de Logins</h3>
            </div>
            <table class="table table-striped" id="listagemLogins">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Utilizador</th>
                        <th scope="col">horaLogin</th>
                        <th scope="col">horaLogout</th>
                    </tr>
                </thead>
                <tbody id="listaLogins"></tbody>
            </table>
        </div>
    </div>
    <?php include "scripts.php"; ?>

</body>
</html>