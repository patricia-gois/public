function registaSocio(){

    let dados = new FormData();
    dados.append ("nome", $('#nomeSocio').val());
    dados.append ("cc", $('#ccSocio').val());
    dados.append ("numsocio", $('#numSocio').val());
    dados.append ("morada", $('#moradaSocio').val());
    dados.append ("email", $('#emailSocio').val());
    dados.append ("telefone", $('#telefoneSocio').val());
    dados.append ("datanasc", $('#dataNascSocio').val());
    dados.append ("estado", $('#estadoSocio').val());
    dados.append ('op', 1);

    $.ajax({
    url: "assets/controller/controllerSocio.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alerta("Success", msg, "success");
        listaSocios();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getSocios() {
    let dados = new FormData();
    dados.append('op', 2);  // fetch list for dropdown

    $.ajax({
        url: "assets/controller/controllerSocio.php",
        method: "POST",
        data: dados,
        dataType: "html",  // Expecting HTML from the server
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        // Populate the select element with the response
        $('#selectSocio').html(msg);
        $('#socioEmprestimo').html(msg);
        $('#socioEmprestimoEdit').html(msg);
    })
    .fail(function(jqXHR, textStatus) {
        // Show error if the request fails
        alert("Request failed: " + textStatus);
    });
}


function getInfoSocio(id) {
    let dados = new FormData();
    dados.append('id', id);
    dados.append('op', 3);  // Operation 2 fetches the book info based on the book ID

    $.ajax({
        url: "assets/controller/controllerSocio.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        let obj = JSON.parse(msg);
        $('#nomeSocioEdit').val(obj.nome);
        $('#ccSocioEdit').val(obj.cc);
        $('#numSocioEdit').val(obj.numsocio);
        $('#moradaSocioEdit').val(obj.morada);
        $('#emailSocioEdit').val(obj.email);
        $('#telefoneSocioEdit').val(obj.telefone);
        $('#dataNascSocioEdit').val(obj.datanasc);
        $('#estadoSocioEdit').val(obj.estado);

        // Set up the button to call the save function
        $('#btnGuardarSocio').attr("onclick", 'guardaEditSocio('+id+')');
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function guardaEditSocio(id) {
    let dados = new FormData();
    dados.append("id", id);
    dados.append("nome", $('#nomeSocioEdit').val());
    dados.append("cc", $('#ccSocioEdit').val());
    dados.append("numsocio", $('#numSocioEdit').val());
    dados.append("morada", $('#moradaSocioEdit').val());
    dados.append("email", $('#emailSocioEdit').val());
    dados.append("telefone", $('#telefoneSocioEdit').val());
    dados.append("datanasc", $('#dataNascSocioEdit').val());
    dados.append("estado", $('#estadoSocioEdit').val());

    dados.append('op', 4);

    $.ajax({
        url: "assets/controller/controllerSocio.php",
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
            //listaSocios();
        } else {
            alerta("Error", parsedResposta.msg, "error");
        }

        //listaSocios();
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function listaSocios(){

    let dados = new FormData();
    dados.append ('op', 5);
   
    $.ajax({
    url: "assets/controller/controllerSocio.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#listaSocios').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerSocio(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 6);
   
    $.ajax({
    url: "assets/controller/controllerSocio.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alerta("Success", msg, "success"); // Use SweetAlert instead of alert
        listaSocios();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
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
new DataTable('#listagemSocios', {
    layout: {
        topStart: 'search',
        topEnd: null
    }
  });

$(function() {
 getSocios();
 listaSocios();
});