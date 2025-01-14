function registaLivro() {
    let dados = new FormData();
    dados.append("titulo", $('#tituloLivro').val());
    dados.append("isbn", $('#isbnLivro').val());
    dados.append("sinopse", $('#sinopseLivro').val());
    dados.append("qtd", $('#qtdLivro').val());
    dados.append("datalanc", $('#dataLancLivro').val());
    dados.append("edicao", $('#edicaoLivro').val());
    dados.append("editora", $('#editoraLivro').val());
    dados.append("idioma", $('#idiomaLivro').val());
    dados.append("qtdpaginas", $('#qtdPaginasLivro').val());
    dados.append("estado", $('#estadoLivro').val());
    dados.append('op', 1);

    $.ajax({
        url: "assets/controller/controllerLivro.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function(resposta) {
        // Manually parse JSON if the dataType is not 'json'
        let parsedResposta = JSON.parse(resposta);
    
        if (parsedResposta.flag) {
            alerta("Success", parsedResposta.msg, "success");
            listaLivros();
        } else {
            alerta("Error", parsedResposta.msg, "error");
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    })
}



function listaLivros(){

    let dados = new FormData();
    dados.append ('op', 3);
   
    $.ajax({
    url: "assets/controller/controllerLivro.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        listaLivrosDropdown();

        $('#listaLivros').html(msg);

    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerLivro(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 6);
   
    $.ajax({
    url: "assets/controller/controllerLivro.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alerta("Success", msg, "success");
        listaLivros();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getInfoLivro(id) {
    let dados = new FormData();
    dados.append('id', id);
    dados.append('op', 4);  // Operation 4 fetches the book info based on the book ID

    $.ajax({
        url: "assets/controller/controllerLivro.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        let obj = JSON.parse(msg);
        $('#tituloLivroEdit').val(obj.titulo);
        $('#isbnLivroEdit').val(obj.isbn);
        $('#sinopseLivroEdit').val(obj.sinopse);
        $('#qtdLivroEdit').val(obj.qtd);
        $('#dataLancLivroEdit').val(obj.datalanc);
        $('#edicaoLivroEdit').val(obj.edicao);
        $('#editoraLivroEdit').val(obj.editora);
        $('#idiomaLivroEdit').val(obj.idioma);
        $('#qtdPaginasLivroEdit').val(obj.qtdpaginas);
        $('#estadoLivroEdit').val(obj.estado);

        // Set up the button to call the save function
        $('#btnGuardarLivro').attr("onclick", 'guardaEditLivro('+id+')');
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}


function guardaEditLivro(id) {
    let dados = new FormData();
    dados.append("id", id); // Send the book ID
    dados.append("titulo", $('#tituloLivroEdit').val());
    dados.append("isbn", $('#isbnLivroEdit').val());
    dados.append("sinopse", $('#sinopseLivroEdit').val());
    dados.append("qtd", $('#qtdLivroEdit').val());
    dados.append("datalanc", $('#dataLancLivroEdit').val());
    dados.append("edicao", $('#edicaoLivroEdit').val());
    dados.append("editora", $('#editoraLivroEdit').val());
    dados.append("idioma", $('#idiomaLivroEdit').val());
    dados.append("qtdpaginas", $('#qtdPaginasLivroEdit').val());
    dados.append("estado", $('#estadoLivroEdit').val());

    dados.append('op', 5);  // Operation 5 for saving the edited book

    $.ajax({
        url: "assets/controller/controllerLivro.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    
    .done(function(msg) {
        // Manually parse JSON if the dataType is not 'json'
        let parsedResposta = JSON.parse(msg);
    
        if (parsedResposta.flag) {
            alerta("Success", parsedResposta.msg, "success");
            listaLivros();
        } else {
            alerta("Error", parsedResposta.msg, "error");
        }

        listaLivros();  // Reload the book list
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function listaLivrosDropdown() {
    let dados = new FormData();
    dados.append('op', 9);  // fetch list for dropdown

    $.ajax({
        url: "assets/controller/controllerLivro.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        $('#selectLivro').html(msg);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

////////////////////////////////////////////////////////////////

//Sweetalert
function alerta(titulo, msg, icon) {
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,
    });
  }
  
  //DataTables
  new DataTable('#listagemLivros', {
    layout: {
        topStart: 'search',
        topEnd: null
    }
  });

$(function() {
    listaLivrosDropdown();
    listaLivros();
});

