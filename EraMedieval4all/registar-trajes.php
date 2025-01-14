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
            <h4>Registar Trajes</h4>
        </div>
        
        <div class="col-6">
            <div class="mb-3">
                <label for="refTraje" class="form-label">Referência:</label>
                <input type="text" class="form-control" id="refTraje">
            </div>
            <div class="mb-3">
                <label for="nomeTraje" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nomeTraje">
            </div>
            <div class="mb-3">
                <label for="estadoTraje" class="form-label">Estado</label>
                <select class="form-select" aria-label="Default select example" id="estadoTraje">
                    <option value="0">Disponível</option>
                    <option value="1">Indisponível</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="valorTraje" class="form-label">Valor</label>
                <input type="number" class="form-control" id="valorTraje">
            </div>
            <div class="mb-3">
                <label for="imagemTraje" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="imagemTraje">
            </div>
            <div class="mb-3">
                <label for="tipoTraje" class="form-label">Tipo</label>
                <select class="form-select" aria-label="Default select example" id="tipoTraje">
                </select>
            </div>                
            <div class="mb-3">
                <label for="armazemTraje" class="form-label">Armazém</label>
                <select class="form-select" aria-label="Default select example" id="armazemTraje">
                </select>
            </div>
            <button type="button" class="btn btn-dark" onclick="registTraje()">Guardar</button>
        </div>
    </div>
    <br><br>
</div>
<?php include "scripts.php"; ?>

</body>
</html>