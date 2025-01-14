<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cineSkills</title>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/function.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    
    <?php include_once 'menu.php' ?>

    <!-- DASHBOARD COM CARDS INFORMATIVAS -->
<div class="container">
    <div class="row">
        <div class="col-12 my-4">
            <h4>Dashboard</h4>
        </div>
        <div class="col-6 my-4">
            <div class="card">
                <div class="card-body">
                  Cinemas
                </div>
                <p id="totalCinemas"></p>
            </div>
        </div>
        <div class="col-6 my-4">
            <div class="card">
                <div class="card-body">
                  Filmes
                </div>
                <p id="totalFilmes"></p>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-4 my-4">

            <div class="mb-3">
                <label for="selectCinema" class="form-label">Selecionar Cinema:</label>
                <select class="form-select" aria-label="Default select example" id="selectCinema">
                </select>
            </div>
        </div>

        <div class="col-12 my-4">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sala</th>
                    <th scope="col">Filme</th>
                    <th scope="col">Data</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Inativar Sessão?</th>

                </tr>
                </thead>
                <tbody id="listaSessoesAtivas">
                <tr>
                    <th scope="row">x</th>
                    <td>x</td>
                    <td>x</td>
                    <td>x</td>
                    <td>x</td>
                    <td><button type="button" class="btn btn-danger">Inativar Sessão</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br><br>
</div>

</body>
</html>