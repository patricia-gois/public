<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>

<body>
<!-- includes the menu -->
<?php include "navbar.php"; ?>

    <!-- Register book  -->
<div class="container">
    <div class="row">
        <div class="col-12 my-4">
            <h4>Registar Eventos</h4>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label for="organizadorEvento" class="form-label">Organizador</label>
                <select class="form-select" aria-label="Default select example" id="organizadorEvento">                    
                </select>
            </div>
            <div class="mb-3">
                <label for="descricaoEvento" class="form-label">Descrição:</label>
                <input type="text" class="form-control" id="descricaoEvento">
            </div>
            <div class="mb-3">
                <label for="localidadeEvento" class="form-label">Localidade:</label>
                <input type="text" class="form-control" id="localidadeEvento">
            </div>
            <div class="mb-3">
                <label for="tituloEvento" class="form-label">Título:</label>
                <input type="text" class="form-control" id="tituloEvento">
            </div>
            <div class="mb-3">
                <label for="dataInicioEvento" class="form-label">Data Início</label>
                <input type="date" class="form-control" id="dataInicioEvento">
            </div>
            <div class="mb-3">
                <label for="dataFimEvento" class="form-label">Data Fim</label>
                <input type="date" class="form-control" id="dataFimEvento">
            </div>
            <div class="mb-3">
                <label for="facebookEvento" class="form-label">Facebook:</label>
                <input type="text" class="form-control" id="facebookEvento">
            </div>
            <div class="mb-3">
                <label for="instagramEvento" class="form-label">Instagram:</label>
                <input type="text" class="form-control" id="instagramEvento">
            </div>
            <div class="mb-3">
                <label for="tiktokEvento" class="form-label">Tiktok:</label>
                <input type="text" class="form-control" id="tiktokEvento">
            </div>

            <button type="button" class="btn btn-dark" onclick="registaEvento()">Guardar</button>
        </div>
    </div>
    <br><br>

   
</div>
<?php include "scripts.php"; ?>

</body>
</html>