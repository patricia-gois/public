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
            <h4>Editar Sócios</h4>
        </div>

        <div class="col-6 my-3">
            <div class="mb-3">
                <label for="selectSocio" class="form-label">Selecionar Sócio:</label>
                <select class="form-select" id="selectSocio" onchange="getInfoSocio(this.value)">
                    <!-- This will be populated by AJAX -->
                </select>
            </div>
            <div class="mb-3">
                <label for="nomeSocioEdit" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nomeSocioEdit">
            </div>
            <div class="mb-3">
                <label for="ccSocioEdit" class="form-label">Cartão de Cidadão:</label>
                <input type="text" class="form-control" id="ccSocioEdit">
            </div>
            <div class="mb-3">
                <label for="numSocioEdit" class="form-label">Nº de Sócio:</label>
                <input type="text" class="form-control" id="numSocioEdit">
            </div>
            <div class="mb-3">
                <label for="moradaSocioEdit" class="form-label">Morada:</label>
                <input type="text" class="form-control" id="moradaSocioEdit">
            </div>
            <div class="mb-3">
                <label for="emailSocioEdit" class="form-label">Email:</label>
                <input type="email" class="form-control" id="emailSocioEdit">
            </div>
            <div class="mb-3">
                <label for="telefoneSocioEdit" class="form-label">Telefone:</label>
                <input type="tel" class="form-control" id="telefoneSocioEdit">
            </div>
            <div class="mb-3">
                <label for="dataNascSocioEdit" class="form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" id="dataNascSocioEdit">
            </div>
            <div class="mb-3">
                <label for="estadoSocioEdit" class="form-label">Estado:</label>
                <select class="form-select" id="estadoSocioEdit">
                    <option value="-1">Selecione uma opção</option>
                    <option value="0">Ativo</option>
                    <option value="1">Inativo</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="btnGuardarSocio">Guardar</button>
        </div>

    </div>
</div>



<?php include "scripts.php"; ?>

</body>
</html>