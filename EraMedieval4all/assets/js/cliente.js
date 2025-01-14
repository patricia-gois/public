function newClient(){

    let dados = new FormData();
    dados.append ("nif", $('#nifCliente').val());
    dados.append ("nome", $('#nomeCliente').val());
    dados.append ("morada", $('#moradaCliente').val());
    dados.append ("email", $('#emailCliente').val());
    dados.append ("telefone", $('#telefoneCliente').val());
    dados.append ("estado", $('#estadoCliente').val());
    dados.append ('op', 1);

    $.ajax({
    url: "assets/controller/controllerClient.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function (msg) {
        let obj = JSON.parse(msg);
            if (obj.flag) {
                alerta("Cliente", obj.msg, "success");
            } else {
                alerta("Cliente", obj.msg, "error");    
            }
        //listClients();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

// function getClients() {
//     let dados = new FormData();
//     dados.append('op', 2);  // fetch list for dropdown

//     $.ajax({
//         url: "assets/controller/client.php",
//         method: "POST",
//         data: dados,
//         dataType: "html",  // Expecting HTML from the server
//         cache: false,
//         contentType: false,
//         processData: false
//     })
//     .done(function(msg) {
//         // Populate the select element with the response
//         $('#xxx').html(msg);

//     })
//     .fail(function(jqXHR, textStatus) {
//         // Show error if the request fails
//         alert("Request failed: " + textStatus);
//     });
// }


function getInfoClient(id) {
    let dados = new FormData();
    dados.append('nif', nif);
    dados.append('op', 3);  // Operation 2 fetches the book info based on the book ID

    $.ajax({
        url: "assets/controller/controllerClient.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        let obj = JSON.parse(msg);
        $('#nifClienteEdit').val(obj.nif);
        $('#nomeClienteEdit').val(obj.nome);
        $('#moradaClienteEdit').val(obj.morada);
        $('#emailClienteEdit').val(obj.email);
        $('#telefoneClienteEdit').val(obj.telefone);
        $('#estadoClienteEdit').val(obj.estado);

        // Set up the button to call the save function
        $('#btnSaveClient').attr("onclick", 'saveEditClient('+nif+')');
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function saveEditClient(nif) {
    let dados = new FormData();
    dados.append("nif", nif);
    dados.append("nif", $('#nifClienteEdit').val());
    dados.append("nome", $('#nomeClienteEdit').val());
    dados.append("morada", $('#moradaClienteEdit').val());
    dados.append("email", $('#emailClienteEdit').val());
    dados.append("telefone", $('#telefoneClienteEdit').val());
    dados.append("estado", $('#estadoClienteEdit').val());


    dados.append('op', 4);

    $.ajax({
        url: "assets/controller/controllerClient.php",
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

function listClients(){

    let dados = new FormData();
    dados.append ('op', 5);
   
    $.ajax({
    url: "assets/controller/controllerClient.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#listaClientes').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removeClient(nif){

    let dados = new FormData();
    dados.append ('nif', nif);
    dados.append ('op', 6);
   
    $.ajax({
    url: "assets/controller/controllerClient.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alerta("Success", msg, "success"); // Use SweetAlert instead of alert
        listClients();
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
new DataTable('#listagemClientes', {
    layout: {
        topStart: 'search',
        topEnd: null
    }
  });

$(function() {
 listClients();
});