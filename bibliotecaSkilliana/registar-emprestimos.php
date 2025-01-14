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
            <h4>Registar Empréstimo</h4>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label for="livroEmprestimo" class="form-label">Livro:</label>
                <select class="form-select" aria-label="livroEmprestimo" id="livroEmprestimo">
                </select>
            </div>
            <div class="mb-3">
                <label for="dataRegistoEmprestimo" class="form-label">Data de registo:</label>
                <input type="date" class="form-control" id="dataRegistoEmprestimo" required>
            </div>
            <div class="mb-3">
                <label for="dataEntregaEmprestimo" class="form-label">Data prevista de entrega:</label>
                <input type="date" class="form-control" id="dataEntregaEmprestimo" required>
            </div>
            <div class="mb-3">
                <label for="utilizadorEmprestimo" class="form-label">Utilizador/funcionário:</label>
                <select class="form-select" aria-label="utilizadorEmprestimo" id="utilizadorEmprestimo">
                </select>
            </div>
            <div class="mb-3">
                <label for="socioEmprestimo" class="form-label">Sócio:</label>
                <select class="form-select" aria-label="socioEmprestimo" id="socioEmprestimo">
                </select>
            </div>

            <button type="button" class="btn btn-dark" onclick="registaEmprestimo()">Guardar</button>
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