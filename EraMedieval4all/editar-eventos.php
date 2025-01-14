<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>
<!-- includes the menu -->
<?php include "navbar.php"; ?>

    <!-- edit book -->
    <div class="container">
        <div class="row">
            
        <div class="col-12 my-4">
            <h4>Editar Eventos</h4>
        </div>
        <div class="col-6 my-3">

        <div class="mb-3">
            <label for="selectEvento" class="form-label">Selecionar Evento:</label>
            <select class="form-select" aria-label="selectEvento" id="selectEvento" onchange="getInfoEvento(this.value)"></select>

        </div>

        <div class="mb-3">
            <label for="organizadorEventoEdit" class="form-label">Organizador</label>
            <select class="form-select" aria-label="selectEvento" id="organizadorEventoEdit">                    
            </select>
        </div>
        <div class="mb-3">
            <label for="descricaoEventoEdit" class="form-label">Descrição:</label>
            <input type="text" class="form-control" id="descricaoEventoEdit">
        </div>
        <div class="mb-3">
            <label for="localidadeEventoEdit" class="form-label">Localidade:</label>
            <input type="text" class="form-control" id="localidadeEventoEdit">
        </div>
        <div class="mb-3">
            <label for="tituloEventoEdit" class="form-label">Título:</label>
            <input type="text" class="form-control" id="tituloEventoEdit">
        </div>
        <div class="mb-3">
            <label for="dataInicioEventoEdit" class="form-label">Data Início</label>
            <input type="date" class="form-control" id="dataInicioEventoEdit">
        </div>
        <div class="mb-3">
            <label for="dataFimEventoEdit" class="form-label">Data Fim</label>
            <input type="date" class="form-control" id="dataFimEventoEdit">
        </div>
        <div class="mb-3">
            <label for="facebookEventoEdit" class="form-label">Facebook:</label>
            <input type="text" class="form-control" id="facebookEventoEdit">
        </div>
        <div class="mb-3">
            <label for="instagramEventoEdit" class="form-label">Instagram:</label>
            <input type="text" class="form-control" id="instagramEventoEdit">
        </div>
        <div class="mb-3">
            <label for="tiktokEventoEdit" class="form-label">Tiktok:</label>
            <input type="text" class="form-control" id="tiktokEventoEdit">
        </div>
    
        <button type="button" class="btn btn-primary" id="btnGuardarEvento">Guardar</button>
    </div>

    </div>
</div>


   
</div>
<?php include "scripts.php"; ?>

</body>
</html>