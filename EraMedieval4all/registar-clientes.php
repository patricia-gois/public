<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['nome'])) {
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
            <h4>Registar Cliente</h4>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label for="nifCliente" class="form-label">NIF:</label>
                <input type="text" class="form-control" id="nifCliente" required>
            </div>
            <div class="mb-3">
                <label for="nomeCliente" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nomeCliente" required>
            </div>
            <div class="mb-3">
                <label for="moradaCliente" class="form-label">Morada:</label>
                <input type="text" class="form-control" id="moradaCliente" required>
            </div>
            <div class="mb-3">
                <label for="emailCliente" class="form-label">Email</label>
                <input type="text" class="form-control" id="emailCliente" required>
            </div>
            <div class="mb-3">
                <label for="telefoneCliente" class="form-label">Telefone:</label>
                <input type="text" class="form-control" id="telefoneCliente" required>
            </div>
            <div class="mb-3">
                <label for="estadoCliente" class="form-label">Estado:</label>
                <input type="text" class="form-control" id="estadoCliente" required>
            </div>
            <button type="button" class="btn btn-dark" onclick="newClient()">Guardar</button>
        </div>
    </div>
</div>

<?php include "scripts.php"; ?>


</body>
</html>
<?php 
    
} else {
    // User is not logged in, redirect to login page
    header("Location: index.html");
    exit();
}
?>