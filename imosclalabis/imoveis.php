<!DOCTYPE html>
<html lang="pt">
<?php
    include "head.php";
?>
<body>

    <!-- MENU -->

    <nav class="navbar navbar-expand-lg" style="background-color: #edf0c1;">
        <div class="mx-5 container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="assets/img/cinemas-logo.png" alt="cineSkills logo" width="100" height="auto">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cinemas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="registar-cinemas.html">Registar</a></li>
                        <li><a class="dropdown-item" href="editar-cinemas.html">Editar</a></li>
                        <li><a class="dropdown-item" href="listar-cinemas.html">Listar</a></li>
                    </ul>
                </li>     
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Salas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="registar-salas.html">Registar</a></li>
                        <li><a class="dropdown-item" href="editar-salas.html">Editar</a></li>
                        <li><a class="dropdown-item" href="listar-salas.html">Listar</a></li>
                    </ul>
                </li>    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Filmes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="registar-filmes.html">Registar</a></li>
                        <li><a class="dropdown-item" href="editar-filmes.html">Editar</a></li>
                        <li><a class="dropdown-item" href="listar-filmes.html">Listar</a></li>
                    </ul>
                </li>      
                <li class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sessões
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="registar-sessoes.html">Registar</a></li>
                        <li><a class="dropdown-item" href="editar-sessoes.html">Editar</a></li>
                        <li><a class="dropdown-item" href="listar-sessoes.html">Listar</a></li>
                    </ul>
                </li>       
            </ul>
          </div>
        </div>
      </nav>

    <!-- REGISTAR NOVO CINEMA -->
<div class="container">
    <div class="row">
        <div class="col-12 my-4">
            <h4>Registar Cinema</h4>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label for="nomeCinema" class="form-label">Nome do Cinema:</label>
                <input type="text" class="form-control" id="nomeCinema">
            </div>

            <div class="mb-3">
                <label for="localSelect" class="form-label">Selecionar Local:</label>
                <select class="form-select" aria-label="Default select example" id="localSelect">
                </select>
            </div>

            <button type="button" class="btn btn-dark" onclick="registaCinema()">Guardar</button>
        </div>
    </div>
    <br><br>

   
</div>

</body>
<?php
    include "footer.php";
?>
</html>