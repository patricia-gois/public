function registaEvento() {
    let dados = new FormData();
    dados.append("id_organizador", $('#organizadorEvento').val());
    dados.append("descricao", $('#descricaoEvento').val());
    dados.append("localidade", $('#localidadeEvento').val());
    dados.append("titulo", $('#tituloEvento').val());
    dados.append("data_inicio", $('#dataInicioEvento').val());
    dados.append("data_fim", $('#dataFimEvento').val());
    dados.append("facebook", $('#facebookEvento').val());
    dados.append("instagram", $('#instagramEvento').val());
    dados.append("tiktok", $('#tiktokEvento').val());
    dados.append('op', 1);

    $.ajax({
        url: "assets/controller/controllerEventos.php",
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
    });
}

function listaEventos(){

    let dados = new FormData();
    dados.append ('op', 3);
   
    $.ajax({
    url: "assets/controller/controllerEventos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        getEventos();
        $('#listaEventos').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerEvento(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 6);
   
    $.ajax({
    url: "assets/controller/controllerEventos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alerta("Success", msg, "success");
        listaEventos();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getInfoEvento(id) {
    let dados = new FormData();
    dados.append('id', id);
    dados.append('op', 4);  // Operation 4 fetches the book info based on the book ID

    $.ajax({
        url: "assets/controller/controllerEventos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        let obj = JSON.parse(msg);
        $('#organizadorEventoEdit').val(obj.id_organizador);
        $('#descricaoEventoEdit').val(obj.descricao);
        $('#localidadeEventoEdit').val(obj.localidade);
        $('#tituloEventoEdit').val(obj.titulo);
        $('#dataInicioEventoEdit').val(obj.data_inicio);
        $('#dataFimEventoEdit').val(obj.data_fim);
        $('#facebookEventoEdit').val(obj.facebook);
        $('#instagramEventoEdit').val(obj.instagram);
        $('#tiktokEventoEdit').val(obj.tiktok);

        // Set up the button to call the save function
        $('#btnGuardarEvento').attr("onclick", 'guardaEditEvento('+id+')');
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}


function guardaEditEvento(id) {
    let dados = new FormData();
    dados.append("id", id); // Send the book ID
    dados.append("id_organizador", $('#organizadorEventoEdit').val());
    dados.append("descricao", $('#descricaoEventoEdit').val());
    dados.append("localidade", $('#localidadeEventoEdit').val());
    dados.append("titulo", $('#tituloEventoEdit').val());
    dados.append("data_inicio", $('#dataInicioEventoEdit').val());
    dados.append("data_fim", $('#dataFimEventoEdit').val());
    dados.append("facebook", $('#facebookEventoEdit').val());
    dados.append("instagram", $('#instagramEventoEdit').val());
    dados.append("tiktok", $('#tiktokEventoEdit').val());

    dados.append('op', 5);  // Operation 5 for saving the edited book

    $.ajax({
        url: "assets/controller/controllerEventos.php",
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
            listaEventos();
        } else {
            alerta("Error", parsedResposta.msg, "error");
        }

        listaEventos();  // Reload the book list
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function getOrganizadores() {
    let dados = new FormData();
    dados.append('op', 9);  // fetch list for dropdown

    $.ajax({
        url: "assets/controller/controllerEventos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        $('#organizadorEvento').html(msg);
        $('#organizadorEventoEdit').html(msg);
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function getEventos() {
    let dados = new FormData();
    dados.append('op', 10);

    $.ajax({
        url: "assets/controller/controllerEventos.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        $('#selectEvento').html(msg);
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
  new DataTable('#listagemEventos', {
    layout: {
        topStart: 'search',
        topEnd: null
    }
  });

$(function() {
    getOrganizadores();
    listaEventos();
});

