<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cineSkills</title>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/function.js"></script>
    <script src="assets/js/functionSala.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
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
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cinemas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="registar-cinemas.html">Registar</a></li>
                        <li><a class="dropdown-item" href="editar-cinemas.html">Editar</a></li>
                        <li><a class="dropdown-item" href="listar-cinemas.html">Listar</a></li>
                    </ul>
                </li>     
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

        <!-- REGISTAR NOVO LOCAL 
        <div class="container">
            <div class="row">
                <div class="col-12 my-4">
                    <h4>Registar Novo Local</h4>
                </div>
                
                <div class="col-6">
                    <div class="mb-3">
                        <label for="descricaoLocal" class="form-label">Descrição/localidade:</label>
                        <input type="text" class="form-control" id="descricaoLocal">
                    </div>
        
                    <button type="button" class="btn btn-dark" onclick="registaLocal()">Registar</button>
        
                </div>
            </div>
            <br><br>
        -->

    <!-- REGISTAR NOVA SALA -->
    <div class="container">
        <div class="row">
            <div class="col-12 my-4">
                <h4>Registar Sala</h4>
            </div>
            
            <div class="col-6">
                <div class="mb-3">
                    <label for="descricaoSala" class="form-label">Descrição Sala:</label>
                    <input type="text" class="form-control" id="descricaoSala">
                </div>
    
                <div class="mb-3">
                    <label for="selectCinemaParaSala" class="form-label">Selecionar Cinema:</label>
                    <select class="form-select" aria-label="Default select example" id="selectCinemaParaSala">
                    </select>
                </div>
    
                <button type="button" class="btn btn-dark" onclick="registarSala()">Guardar</button>
    
            </div>
        </div>
        <br><br>
</div>

</body>
</html>