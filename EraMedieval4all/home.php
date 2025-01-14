<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['nome'])) {
    
    // Check if the user's id_tipo is 3
    if($_SESSION['status_login'] == 'ativo') {
        // User is authorized, show the content
?>

<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>
    <?php include "navbar.php"; ?>

        <div class="row">
            <img src="assets/img/books.jpg" class="img-books img-fluid" alt="books">
        </div>
    <?php include "scripts.php"; ?>

</body>
</html>

<?php 
    } else {
        // User does not have the required permissions, redirect to access denied page
        header("Location: index.html");
        exit();
    }
    
} else {
    // User is not logged in, redirect to login page
    header("Location: index.html");
    exit();
}
?>