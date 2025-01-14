<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>

<body>
<!-- includes the menu -->
<?php include "navbar.php"; ?>

<!-- Register users  -->
<div class="container">
    <div class="row">
        <div class="col-12 my-4">
            <h4>Registar Colaborador</h4>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label for="nomeFunc" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nomeFunc">
            </div>
            <div class="mb-3">
                <label for="moradaFunc" class="form-label">Morada:</label>
                <input type="text" class="form-control" id="moradaFunc">
            </div>
            <div class="mb-3">
                <label for="telefoneFunc" class="form-label">Telefone:</label>
                <input type="tel" class="form-control" id="telefoneFunc">
            </div>
            <div class="mb-3">
                <label for="emailFunc" class="form-label">Email:</label>
                <input type="email" class="form-control" id="emailFunc">
            </div>
            <div class="mb-3">
                <label for="numFunc" class="form-label">Nº de Funcionário:</label>
                <input type="text" class="form-control" id="numFunc">
            </div>
            <div class="mb-3">
                <label for="numccFunc" class="form-label">Nº de Cartão de Cidadão:</label>
                <input type="number" class="form-control" id="numccFunc" maxlength="12">
            </div>

            <div class="mb-3">
                <label for="dataNascFunc" class="form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" id="dataNascFunc">
                <div id="error-message" class="text-danger" style="display:none;"></div>
            </div>

            <div class="mb-3">
                    <label for="tipoFunc" class="form-label">Tipo de Funcionário:</label>
                    <select class="form-select" aria-label="Default select example" id="tipoFunc" required>
                    </select>
            </div>

            <button type="button" class="btn btn-dark" onclick="registaColaborador()">Guardar</button>
        </div>
    </div>
</div>

<?php include "scripts.php" ?>
</body>
</html>