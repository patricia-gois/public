<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>
<!-- includes the menu -->
<?php include "navbar.php"; ?>

    <div class="container">
        <div class="row">
            
        <div class="col-12 my-4">
            <h4>Editar Trajes</h4>
        </div>
        <div class="col-6 my-3">

        <div class="mb-3">
            <label for="selectTraje" class="form-label">Selecionar Traje:</label>
            <select class="form-select" aria-label="selectTraje" id="selectTraje" onchange="getInfoTraje(this.value)"></select>

        </div>

        <div class="mb-3">
                <label for="refTrajeEdit" class="form-label">Referência:</label>
                <input type="text" class="form-control" id="refTrajeEdit">
            </div>
            <div class="mb-3">
                <label for="nomeTrajeEdit" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nomeTrajeEdit">
            </div>
            <div class="mb-3">
                <label for="estadoTrajeEdit" class="form-label">Estado</label>
                <select class="form-select" aria-label="Default select example" id="estadoTrajeEdit">
                    <option value="0">Disponível</option>
                    <option value="1">Indisponível</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="valorTrajeEdit" class="form-label">Valor</label>
                <input type="number" class="form-control" id="valorTrajeEdit">
            </div>
            <div class="mb-3">
                <label for="imagemTrajeEdit" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="imagemTrajeEdit">
            </div>
            <div class="mb-3">
                <label for="tipoTrajeEdit" class="form-label">Tipo</label>
                <select class="form-select" aria-label="Default select example" id="tipoTrajeEdit">
                </select>
            </div>                
            <div class="mb-3">
                <label for="armazemTrajeEdit" class="form-label">Armazém</label>
                <select class="form-select" aria-label="Default select example" id="armazemTrajeEdit">
                </select>
            </div>
    
        <button type="button" class="btn btn-primary" id="btnGuardarTraje">Guardar</button>
    </div>

    </div>
</div>


   
</div>
<?php include "scripts.php"; ?>

</body>
</html>