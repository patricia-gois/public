function registaCliente(){

    let dados = new FormData();
    dados.append ("nif", $('#nifCliente').val());
    dados.append ("nome", $('#nomeCliente').val());
    dados.append ("email", $('#moradaCliente').val());
    dados.append ("telefone", $('#telefoneCliente').val());
    dados.append ("morada", $('#emailCliente').val());
    dados.append ("cod_postal", $('#codPostalCliente').val());
    dados.append ("localizacao_id", $('#selectLocalidade').val());

    dados.append ('op', 1);
   

    $.ajax({
    url: "assets/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        //listaClientes();
        //contagemCinemas();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function listaClientes(){

    let dados = new FormData();
    dados.append ('op', 2);
   
    $.ajax({
    url: "assets/controller/controllerClientes.php",
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

function removerClientes(id){

    let dados = new FormData();
    dados.append ('nif', id);
    dados.append ('op', 3);
   
    $.ajax({
    url: "assets/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        //listaCinemas();
        //contagemCinemas();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getCliente(){

    let dados = new FormData();
    dados.append('op', 7);
  
  
    $.ajax({
      url: "assets/controller/controllerClientes.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData:false,
    })
    
    .done(function( msg ) {
     $('#selectCliente').html(msg);     
     //$('#selectCinemaParaSala').html(msg);
     //$('#selectCinemaParaSalaEdit').html(msg);

    })
    
    .fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
  }

function getCliente(id){

    let dados = new FormData();
    dados.append ('nif', id);
    dados.append ('op', 4);
   
    $.ajax({
    url: "assets/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        let obj = JSON.parse(msg);
        $('#nomeClienteEdit').val(obj.nome);
        $('#moradaClienteEdit').val(obj.morada);
        $('#telefoneClienteEdit').val(obj.tel);
        $('#emailClienteEdit').val(obj.email);
        $('#moradaClienteEdit').val(obj.morada);
        $('#codPostalClienteEdit').val(obj.cod_postal);
        $('#selectLocalidadeEdit').val(obj.localidade);

        $('#btnGuardarCliente').attr("onclick", 'gravarEdicaoCliente('+nif+')');
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function gravarEdicaoCliente(){

    let dados = new FormData();
    dados.append ("nome", $('#nomeClienteEdit').val());
    dados.append ("email", $('#moradaClienteEdit').val());
    dados.append ("telefone", $('#telefoneClienteEdit').val());
    dados.append ("morada", $('#emailClienteEdit').val());
    dados.append ("cod_postal", $('#codPostalClienteEdit').val());
    dados.append ("localizacao_id", $('#selectLocalidadeEdit').val());
    dados.append ("nif", $('#selectCliente').val());
    dados.append ('op', 5);
   

    $.ajax({
    url: "assets/controller/controllerClientes.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}

function getLocalizacao(){

    let dados = new FormData();
    dados.append('op', 6);
  
  
    $.ajax({
      url: "assets/controller/controllerClientes.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData:false,
    })
    
    .done(function( msg ) {
     $('#localSelect').html(msg);
     $('#editLocalSelect').html(msg);

    })
    
    .fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
  }

//   function contagemCinemas(){

//     let dados = new FormData();
//     dados.append ('op', 8);
   
//     $.ajax({
//     url: "assets/controller/controllerCinema.php",
//     method: "POST",
//     data: dados,
//     dataType: "html",
//     cache: false,
//     contentType: false,
//     processData: false
//     })
//     .done(function( msg ) {
//         $('#totalCinemas').html(msg);
//     })
    
//     .fail(function( jqXHR, textStatus ) {
//     alert( "Request failed: " + textStatus );
//     });
// }

$(function() {
    listaClientes();
    getLocalizacao();
    getCliente();
    //contagemCinemas();
});

