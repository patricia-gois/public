<?php
// Determine the current page
$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name
?>

<nav class="navbar navbar-expand-lg" style="background-color: #a3a3a3;">
    <div class="mx-5 container-fluid">
        <a class="navbar-brand">
            <img src="assets/img/logo.png" alt="logo" width="200" height="auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php" role="button">
                        Dashboard 
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-trajes.php' || $current_page == 'editar-trajes.php' || $current_page == 'listar-trajes.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Trajes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-trajes.php' ? 'active' : ''; ?>" href="registar-trajes.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-trajes.php' ? 'active' : ''; ?>" href="editar-trajes.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-trajes.php' ? 'active' : ''; ?>" href="listar-trajes.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-clientes.php' || $current_page == 'editar-clientes.php' || $current_page == 'listar-clientes.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Clientes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-clientes.php' ? 'active' : ''; ?>" href="registar-clientes.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-clientes.php' ? 'active' : ''; ?>" href="editar-clientes.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-clientes.php' ? 'active' : ''; ?>" href="listar-clientes.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-eventos.php' || $current_page == 'editar-eventos.php' || $current_page == 'listar-eventos.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Eventos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-eventos.php' ? 'active' : ''; ?>" href="registar-eventos.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-eventos.php' ? 'active' : ''; ?>" href="editar-eventos.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-eventos.php' ? 'active' : ''; ?>" href="listar-eventos.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-aluguer.php' || $current_page == 'editar-aluguer.php' || $current_page == 'listar-aluguer.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Aluguer
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-aluguer.php' ? 'active' : ''; ?>" href="registar-aluguer.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-aluguer.php' ? 'active' : ''; ?>" href="editar-aluguer.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-aluguer.php' ? 'active' : ''; ?>" href="listar-aluguer.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-organizadores.php' || $current_page == 'editar-organizadores.php' || $current_page == 'listar-organizadores.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Organizadores
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-organizadores.php' ? 'active' : ''; ?>" href="registar-organizadores.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-organizadores.php' ? 'active' : ''; ?>" href="editar-organizadores.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-organizadores.php' ? 'active' : ''; ?>" href="listar-organizadores.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($current_page == 'registar-utilizadores.php' || $current_page == 'editar-utilizadores.php' || $current_page == 'listar-utilizadores.php') ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Utilizadores
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $current_page == 'registar-utilizadores.php' ? 'active' : ''; ?>" href="registar-utilizadores.php">Registar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'editar-utilizadores.php' ? 'active' : ''; ?>" href="editar-utilizadores.php">Editar</a></li>
                        <li><a class="dropdown-item <?= $current_page == 'listar-utilizadores.php' ? 'active' : ''; ?>" href="listar-utilizadores.php">Listar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="auditoria-logins.php">Auditoria</a>
                </li>

                <li class="nav-item" >
                    <button type="button" class="btn" onclick="logout()">Sair</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

