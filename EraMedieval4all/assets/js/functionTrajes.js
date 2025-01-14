function registTraje() {
    let dados = new FormData();
    dados.append("ref", $('#refTraje').val());
    dados.append("nome", $('#nomeTraje').val());
    dados.append("estado", $('#estadoTraje').val());
    dados.append("valor", $('#valorTraje').val());
    dados.append("imagem", $('#imagemTraje').prop('files')[0]);
    dados.append("id_tipo", $('#tipoTraje').val());
    dados.append("id_armazem", $('#armazemTraje').val());
    dados.append('op', 1);

    $.ajax({
        url: "assets/controller/controllerTraje.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(resposta) {
        let parsedResposta = JSON.parse(resposta);
    
        if (parsedResposta.flag) {
            alerta("Success", parsedResposta.msg, "success");
        } else {
            alerta("Error", parsedResposta.msg, "error");
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function removeTraje(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 5);
   
    $.ajax({
    url: "assets/controller/controllerTraje.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alerta("Success", msg, "success");
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getInfoTraje(ref) {
    let dados = new FormData();
    dados.append('ref', ref);
    dados.append('op', 3);  // Operation 4 fetches the book info based on the book ID

    $.ajax({
        url: "assets/controller/controllerTraje.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        let obj = JSON.parse(msg);
        $('#refTrajeEdit').val(obj.ref);
        $('#nomeTrajeEdit').val(obj.nome);
        $('#estadoTrajeEdit').val(obj.estado);
        $('#valorTrajeEdit').val(obj.valor);
        $('#imagemTrajeEdit').val(obj.imagem);
        $('#tipoTrajeEdit').val(obj.id_tipo);
        $('#armazemTrajeEdit').val(obj.id_armazem);

        // Set up the button to call the save function
        $('#btnGuardarTraje').attr("onclick", 'guardaEditTraje('+ref+')');
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function saveEditTraje(ref) {
    let dados = new FormData();
    let foto = $('#imagemTrajeEdit')[0].files[0]; // gets image file from traje input

    dados.append("ref", ref); // Send the traje ID
    dados.append("nome", $('#refTrajeEdit').val());
    dados.append("estado", $('#nomeTrajeEdit').val());
    dados.append("valor", $('#valorTrajeEdit').val());
    dados.append("imagem", foto);
    dados.append("id_tipo", $('#tipoTrajeEdit').val());
    dados.append("id_armazem", $('#armazemTrajeEdit').val());

    dados.append('op', 4);  // Operation for saving the edited traje

    $.ajax({
        url: "assets/controller/controllerTraje.php",
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
        } else {
            alerta("Error", parsedResposta.msg, "error");
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function getTiposTraje() {
    let dados = new FormData();
    dados.append('op', 7);  // fetch list for dropdown

    $.ajax({
        url: "assets/controller/controllerTraje.php",
        method: "POST",
        data: dados,
        dataType: "html",  // Expecting HTML from the server
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        // Populate the select element with the response
        $('#tipoTraje').html(msg);
        $('#tipoTrajeEdit').html(msg);

    })
    .fail(function(jqXHR, textStatus) {
        // Show error if the request fails
        alert("Request failed: " + textStatus);
    });
}

function getArmazens() {
    let dados = new FormData();
    dados.append('op', 8);  // fetch list for dropdown

    $.ajax({
        url: "assets/controller/controllerTraje.php",
        method: "POST",
        data: dados,
        dataType: "html",  // Expecting HTML from the server
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        $('#armazemTraje').html(msg);
        $('#armazemTrajeEdit').html(msg);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function listTrajes(){

    let dados = new FormData();
    dados.append ('op', 2);
   
    $.ajax({
    url: "assets/controller/controllerTraje.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#listaTrajes').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getTrajes() {
    let dados = new FormData();
    dados.append('op', 11);

    $.ajax({
        url: "assets/controller/controllerTraje.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        $('#selectTraje').html(msg);
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
  new DataTable('#listagemTrajes', {
    layout: {
        topStart: 'search',
        topEnd: null
    }
  });

$(function() {
    getTiposTraje();
    getArmazens();
    listTrajes();
    getTrajes();
});

