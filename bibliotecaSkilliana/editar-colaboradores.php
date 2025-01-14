<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>
<!-- includes the menu -->
<?php include "navbar.php"; ?>

    <!-- edit staff -->
    <div class="container">
        <div class="row">
            
            <div class="col-12 my-4">
                <h4>Editar Colaboradores</h4>
            </div>
            
            <div class="col-6 my-3">
                <div class="mb-3">
                    <label for="selectColaborador" class="form-label">Selecionar Colaborador:</label>
                    <select class="form-select" id="selectColaborador" onchange="getInfoColaborador(this.value)">

                    </select>
                </div>
                <div class="mb-3">
                    <label for="idFuncEdit" class="form-label">ID:</label>
                    <input type="text" class="form-control" id="idFuncEdit" disabled>
                </div>
                <div class="mb-3">
                    <label for="nomeFuncEdit" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nomeFuncEdit">
                </div>
                <div class="mb-3">
                    <label for="moradaFuncEdit" class="form-label">Morada:</label>
                    <input type="text" class="form-control" id="moradaFuncEdit">
                </div>
                <div class="mb-3">
                    <label for="telefoneFuncEdit" class="form-label">Telefone:</label>
                    <input type="text" class="form-control" id="telefoneFuncEdit">
                </div>
                <div class="mb-3">
                    <label for="emailFuncEdit" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="emailFuncEdit">
                </div>
                <div class="mb-3">
                    <label for="numFuncEdit" class="form-label">Nº de Funcionário:</label>
                    <input type="text" class="form-control" id="numFuncEdit">
                </div>
                <div class="mb-3">
                    <label for="numccFuncEdit" class="form-label">Nº de Cartão de Cidadão:</label>                        
                    
                    <input type="text" class="form-control" id="asteriscos" value="********">

                    <div class="mb-3" id="numccFuncEditContainer" style="display: none;">
                        <input type="number" class="form-control" id="numccFuncEdit">
                    </div>

                    <button type="button" class="btn btn-primary mt-3" onclick="toggleNumCC()">Mostrar/Esconder CC</button>
                </div>
            
                <div class="mb-3">
                    <label for="dataNascFuncEdit" class="form-label">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="dataNascFuncEdit">
                </div>
                <div class="mb-3">
                    <label for="tipoFuncEdit" class="form-label">Tipo:</label>
                    <select class="form-select" id="tipoFuncEdit" onclick="getTiposFunc()">
                    </select>
                </div>

                <button type="button" class="btn btn-primary" id="btnGuardarColaborador">Guardar</button>
            </div>
        </div>
    </div>
    <?php include "scripts.php"; ?>

</body>
</html>