<?php
// Determine the current page
$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name
?>

<nav class="navbar navbar-expand-lg" style="background-color: #a3a3a3;">
    <div class="mx-5 container-fluid">
        <a class="navbar-brand">
            <img src="assets/img/logo.png" alt="logo" width="100" height="auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link <?= ($current_page == 'home.php') ? 'active' : ''; ?>" href="home.php" role="button">
                        Home 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php" role="button">
                        Dashboard 
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-livros.php' || $current_page == 'editar-livros.php' || $current_page == 'listar-livros.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Livros
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-livros.php' ? 'active' : ''; ?>" href="registar-livros.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-livros.php' ? 'active' : ''; ?>" href="editar-livros.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-livros.php' ? 'active' : ''; ?>" href="listar-livros.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-socios.php' || $current_page == 'editar-socios.php' || $current_page == 'listar-socios.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sócios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-socios.php' ? 'active' : ''; ?>" href="registar-socios.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-socios.php' ? 'active' : ''; ?>" href="editar-socios.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-socios.php' ? 'active' : ''; ?>" href="listar-socios.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-emprestimos.php' || $current_page == 'editar-emprestimos.php' || $current_page == 'listar-emprestimos.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Empréstimos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-emprestimos.php' ? 'active' : ''; ?>" href="registar-emprestimos.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-emprestimos.php' ? 'active' : ''; ?>" href="editar-emprestimos.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-emprestimos.php' ? 'active' : ''; ?>" href="listar-emprestimos.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-colaboradores.php' || $current_page == 'editar-colaboradores.php' || $current_page == 'listar-colaboradores.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Colaboradores
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-colaboradores.php' ? 'active' : ''; ?>" href="registar-colaboradores.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-colaboradores.php' ? 'active' : ''; ?>" href="editar-colaboradores.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-colaboradores.php' ? 'active' : ''; ?>" href="listar-colaboradores.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="logout()" role="button">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>