<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>
<?php include "navbar.php"; ?>

<!-- DASHBOARD COM CARDS INFORMATIVAS -->
<div class="container">
    <div class="row">
        
        <div class="col-12 my-4">
            <h4>Dashboard</h4>
        </div>
        
        <div class="col-6 my-4">
        <div class="card">
            <div class="card-body">
                <h4>Qtd. Livros Emprestados</h4>
                <h1 id="">3054</h1>
            </div>
        </div>
        </div>

        <div class="col-6 my-4">
        <div class="card">
            <div class="card-body">
                <h4>Sócios Ativos</h4>
                <h1 id="">683</h1>
            </div>
        </div>
    </div>

        <div class="col-6 my-4">
        <div class="card">
            <div class="card-body">
                <h4>Livros Registados</h4>
                <h1 id="">9386</h1>
            </div>
        </div>
    </div>

        <div class="col-6 my-4">
        <div class="card">
            <div class="card-body">
                <h4>Empréstimos na última semana</h4>
                <h1 id="">40</h1>
            </div>
        </div>
    </div>

        <div class="col-6 my-4">
        <div class="card">
            <div class="card-body">
                <h4>Sócio com mais empréstimos</h4>
                <h1 id="">Sócio 5</h1>
            </div>
        </div>
        </div>
    </div>
</div>

        <div class="container">
            <div class="row mb-4">

            <div class="mb-3"></div>
                <h4>Empréstimos em atraso</h4>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Custom</th>
                    <th scope="col">Custom</th>
                    <th scope="col">Custom</th>
                    <th scope="col">Custom?</th>
                </tr>
                </thead>
                <tbody id="">
                </tbody>
            </table>
        </div>
    </div>

        <div class="container">
            <div class="row mb-4">

            <div class="mb-3"></div>
                <h4>Sócios Inativos A-Z</h4>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Custom</th>
                    <th scope="col">Custom</th>
                    <th scope="col">Custom</th>
                    <th scope="col">Custom?</th>
                </tr>
                </thead>
                <tbody id="">
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include "scripts.php"; ?>
</body>
</html>