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
<?php include "navbar.php"; ?>

<!-- ponto 14 - pagina home com imagem relativa à biblioteca, acesso ao menu -->
    <div class="row">
        <img src="assets/img/books.jpg" class="img-books img-fluid" alt="books">
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