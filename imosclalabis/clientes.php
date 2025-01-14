<!DOCTYPE html>
<html lang="en">
    <?php include "head.php"; ?>
    
    <body class="d-flex flex-column min-vh-100">

    <?php include "navbar.php"; ?>

        <!-- REGISTO -->
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <h3>Registar cliente</h3>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="nifCliente" class="form-label" >NIF:</label>
                        <i class="fa-solid fa-droplet" style="color: #855050;"></i>
                        <input type="number" class="form-control" id="nifCliente" maxlength="9" pattern="\d{9}">
                    </div>
                    <div class="mb-3">
                        <label for="nomeCliente" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nomeCliente">
                    </div>
                    <div class="mb-3">
                        <label for="telefoneCliente" class="form-label">Telefone:</label>
                        <input type="number" class="form-control" id="telefoneCliente">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="emailCliente" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="emailCliente">
                    </div>
                    <div class="mb-3">
                        <label for="moradaCliente" class="form-label">Morada:</label>
                        <input type="text" class="form-control" id="moradaCliente">
                    </div>
                    <div class="mb-3">
                        <label for="codPostalCliente" class="form-label">Código Postal:</label>
                        <input type="number" class="form-control" id="codPostalCliente" pattern="\d{4}-\d{3}">
                    </div>
                    <div class="mb-3">
                        <label for="selectLocalidade" class="form-label">Localidade:</label>
                            <select class="form-select" aria-label="Default select example" id="selectLocalidade"></select>
                    </div>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-dark" onclick="registaCliente()">Registar</button>
                </div>
            </div>  
        </div>

<!-- LISTAR CLIENTES -->
<div class="cliente container mt-4 mb-3">
        <div class="row">
            <div class="col-12 mt-4">
                <h3>Lista de clientes</h3>
            </div>
            <table class="table table-striped" id="listagemClientes">
                <thead>
                    <tr>
                        <th scope="col">NIF</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Morada</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Morada</th>
                        <th scope="col">Código Postal</th>
                        <th scope="col">Localidade</th>
                        <th scope="col">Editar?</th>
                    </tr>
                </thead>
                <tbody id="listaClientes"></tbody>
            </table>
        </div>
    </div>

    <!-- Modal EDITA CLIENTE -->
    <div class="modal fade" id="modalEditCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar cliente com o nome <span id="nomeClienteModalHeader"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nifClienteEdit" class="form-label">NIF:</label>
                        <input type="number" class="form-control" id="nifClienteEdit">
                    </div>
    
                    <div class="mb-3">
                        <label for="nomeClienteEdit" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nomeClienteEdit">
                    </div>
    
                    <div class="mb-3">
                        <label for="telefoneClienteEdit" class="form-label">Telefone:</label>
                        <input type="number" class="form-control" id="telefoneClienteEdit">
                    </div>
    
                    <div class="mb-3">
                        <label for="emailClienteEdit" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="emailClienteEdit">
                    </div>

                    <div class="mb-3">
                        <label for="moradaClienteEdit" class="form-label">Morada:</label>
                        <input type="text" class="form-control" id="moradaClienteEdit">
                    </div>

                    <div class="mb-3">
                        <label for="codPostalClienteEdit" class="form-label">Código Postal:</label>
                        <input type="text" class="form-control" id="codPostalClienteEdit">
                    </div>

                    <div class="mb-3">
                        <label for="selectLocalidadeEdit" class="form-label">Localidade:</label>
                            <select class="form-select" aria-label="Default select example" id="selectLocalidadeEdit"></select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

</body>
<?php include "footer.php"; ?>
</html>