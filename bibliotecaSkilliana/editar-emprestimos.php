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
                <h4>Editar Empréstimo</h4>
            </div>
            
            <div class="col-6 my-3">
                <div class="mb-3">
                    <label for="selectEmprestimo" class="form-label">Selecionar Empréstimo:</label>
                    <select class="form-select" id="selectEmprestimo" onchange="getInfoEmprestimo(this.value)">         
                                  
                    </select>
                </div>
                <div class="mb-3">
                    <label for="idEmprestimo" class="form-label">ID:</label>
                    <input type="text" class="form-control" id="idEmprestimo" disabled>
                </div>
                <div class="mb-3">
                    <label for="livroEmprestimoEdit" class="form-label">Livro:</label>
                    <select class="form-select" aria-label="livroEmprestimoEdit" id="livroEmprestimoEdit">
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dataRegistoEmprestimoEdit" class="form-label">Data de registo:</label>
                    <input type="date" class="form-control" id="dataRegistoEmprestimoEdit" required>
                </div>
                <div class="mb-3">
                    <label for="dataEntregaEmprestimoEdit" class="form-label">Data prevista de entrega:</label>
                    <input type="date" class="form-control" id="dataEntregaEmprestimoEdit" required>
                </div>
                <div class="mb-3">
                    <label for="utilizadorEmprestimoEdit" class="form-label">Utilizador/funcionário:</label>
                    <select class="form-select" aria-label="utilizadorEmprestimoEdit" id="utilizadorEmprestimoEdit">
                    </select>
                </div>
                <div class="mb-3">
                    <label for="socioEmprestimoEdit" class="form-label">Sócio:</label>
                    <select class="form-select" aria-label="socioEmprestimoEdit" id="socioEmprestimoEdit">
                    </select>
                </div>

                <button type="button" class="btn btn-primary" id="btnGuardarEmprestimo">Guardar</button>
            </div>
        </div>
    </div>
    
    <?php include "scripts.php"; ?>

</body>
</html>