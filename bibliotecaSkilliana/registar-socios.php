<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    
    // Check if the user's id_tipo is 3
    if($_SESSION['id_tipo'] == 3) {
        // User is authorized, show the content
        ?>

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
            <h4>Registar Sócio</h4>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label for="nomeSocio" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nomeSocio" required>
            </div>
            <div class="mb-3">
                <label for="ccSocio" class="form-label">Cartão de Cidadão:</label>
                <input type="text" class="form-control" id="ccSocio" required>
            </div>
            <div class="mb-3">
                <label for="numSocio" class="form-label">Nº de Sócio:</label>
                <input type="text" class="form-control" id="numSocio" required>
            </div>
            <div class="mb-3">
                <label for="moradaSocio" class="form-label">Morada:</label>
                <input type="text" class="form-control" id="moradaSocio" required>
            </div>
            <div class="mb-3">
                <label for="emailSocio" class="form-label">Email:</label>
                <input type="email" class="form-control" id="emailSocio" required>
            </div>
            <div class="mb-3">
                <label for="telefoneSocio" class="form-label">Telefone:</label>
                <input type="tel" class="form-control" id="telefoneSocio" required>
            </div>
            <div class="mb-3">
                <label for="dataNascSocio" class="form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" id="dataNascSocio" required>
            </div>
            <div class="mb-3">
                <label for="estadoSocio" class="form-label">Estado:</label>
                <select class="form-select" aria-label="Default select example" id="estadoSocio">
                    <option value="-1">Selecione uma opção</option>
                    <option value="0">Ativo</option>
                    <option value="1">Inativo</option>
                </select>
            </div>

            <button type="button" class="btn btn-dark" onclick="registaSocio()">Guardar</button>
        </div>
    </div>
</div>

<?php include "scripts.php"; ?>


</body>
</html>
<?php 
    } else {
        // User does not have the required permissions, redirect to access denied page
        header("Location: acesso_negado.php");
        exit();
    }
    
} else {
    // User is not logged in, redirect to login page
    header("Location: index.html");
    exit();
}
?>