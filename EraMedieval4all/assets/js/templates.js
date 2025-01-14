//DESTINOS


function registaDestino() {

  let dados = new FormData();
  dados.append("op", 1);
  dados.append("descricao", $('#descricaoDestino').val());
  dados.append("localidade", $('#localidadeDestino').val());
  dados.append("observacoes", $('#observacoesDestino').val());
  dados.append("valor", $('#valorDestino').val());
  dados.append("img_capa", $('#fotoDestino').prop('files')[0]);

  $.ajax({
      url: "src/controller/controllerDestino.php",
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
              alerta("Destino", obj.msg, "success");
              listaPratos();
          } else {
              alerta("Destino", obj.msg, "error");
          }

      })

      .fail(function (jqXHR, textStatus) {
          alert("Request failed: " + textStatus);
      });
}

function listaDestinos(){

  if ($.fn.DataTable.isDataTable('#listagemDestinos')) {
    $('#listagemDestinos').DataTable().destroy();
}

  let dados = new FormData();
  dados.append ('op', 2);
 
  $.ajax({
  url: "src/controller/controllerDestino.php",
  method: "POST",
  data: dados,
  dataType: "html",
  cache: false,
  contentType: false,
  processData: false
  })
  .done(function( msg ) {
      $('#listaDestinos').html(msg);
      $('#listagemDestinos').DataTable();
  })
  
  .fail(function( jqXHR, textStatus ) {
  alert( "Request failed: " + textStatus );
  });
}

/* function removerPrato(id){

  let dados = new FormData();
  dados.append ('id', id);
  dados.append ('op', 2);
 
  $.ajax({
  url: "src/controller/controllerPrato.php",
  method: "POST",
  data: dados,
  dataType: "html",
  cache: false,
  contentType: false,
  processData: false
  })
  .done(function( msg ) {
    alerta("Sucesso", obj.msg, "success");
    listaPratos();
  })
  
  .fail(function( jqXHR, textStatus ) {
  alert( "Request failed: " + textStatus );
  });
} */

/* function getDadosPrato(id) {


  let dados = new FormData();
  dados.append("op", 4);
  dados.append("id", id);

  $.ajax({
      url: "src/controller/controllerPrato.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData: false
  })

  .done(function (msg) {

      let obj = JSON.parse(msg);
      $('#idPratoEdit').val(obj.id); // para mostrar o ID no campo input disables
      $('#nomePratoEdit').val(obj.nome);
      $('#precoPratoEdit').val(obj.preco);
      $('#idtipoPratoEdit').val(obj.idTipo);
      $('#fotoPratoEditXXX').attr('src', obj.foto); // para mostrar foto registada em primeiro lugar

      // Set the name in the modal header span
      $('#nomePratoModalHeader').text(obj.nome);

      $('#btnGuardarEdicaoPrato').attr("onclick", "guardaEditPrato(" + obj.id + ")");
      $('#modalEditPrato').modal('show');
  })

  .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
  });


} */

/* function guardaEditPrato(idOld) {

  let dados = new FormData();
  let foto = $('#fotoPratoEdit')[0].files[0]; // variavel vai buscar o arquivo do input file da foto

  dados.append("op", 5);
  dados.append("id", $('#idPratoEdit').val());
  dados.append("nome", $('#nomePratoEdit').val());
  dados.append("preco", $('#precoPratoEdit').val());
  dados.append("idTipo", $('#idtipoPratoEdit').val());
  dados.append('foto', foto); // enviar a nova foto para o servidor???
  dados.append("idOld", idOld);

  $.ajax({
      url: "src/controller/controllerPrato.php",
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
          alerta("Sucesso", obj.msg, "success");
          listaPratos();
          getSelectTipoPrato();
          $('#modalEditPrato').modal('hide')
      } else {
          alerta("Erro", obj.msg, "error");
      }
  })
  .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
  });
} */

// RESERVA

function registaReserva() {
  let dados = new FormData();
  dados.append('idCliente', $('#idClienteReserva').val());
  dados.append('idMesa', $('#idMesaReserva').val());
  dados.append('data', $('#dataReserva').val());
  dados.append('hora', $('#horaReserva').val());
  dados.append('estado', $('#idEstadoReserva').val());
  dados.append('op', 1);

  $.ajax({
    url: "src/controller/controllerReserva.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(function( msg ) {

    let obj = JSON.parse(msg);
    if (obj.flag) {
        alerta("Sucesso", obj.msg, "success");
        getClientes();
        getMesas();
        getEstadosReserva();
    } else {
        alerta("Erro", obj.msg, "error");
    }

 })
  .fail(function( jqXHR, textStatus ) {
    alert( "Erro! " + textStatus );
 });
}

  function listaReservas(){

    if ($.fn.DataTable.isDataTable('#listagemReservas')) {
      $('#listagemReservas').DataTable().destroy();
  }
  
    let dados = new FormData();
    dados.append ('op', 4);
   
    $.ajax({
    url: "src/controller/controllerReserva.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#listaReservas').html(msg);
        $('#listagemReservas').DataTable();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
  }

function getClientes(){

  let dados = new FormData();
  dados.append('op', 2);

  $.ajax({
    url: "src/controller/controllerReserva.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#idClienteReserva').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getEstadosReserva(){

  let dados = new FormData();
  dados.append('op', 3);

  $.ajax({
    url: "src/controller/controllerReserva.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#idEstadoReserva').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function cancelarReserva(id) {
  let dados = new FormData();
  dados.append('op', 5);
  dados.append('id', id);

  $.ajax({
    url: "src/controller/controllerReserva.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(function(msg) {
    let obj = JSON.parse(msg);
    if (obj.flag) {
      alerta("Sucesso", obj.msg, "success");
      listaReservas(); //atualiza a lista já com o estado cancelado
    } else {
      alerta("Erro", obj.msg, "error");
    }
  })
  .fail(function(jqXHR, textStatus) {
    alert("Erro! " + textStatus);
  });
}

function removerReserva(id) {
  console.log("Remover reserva function called with id:", id);
  let dados = new FormData();
  dados.append('id', id);
  dados.append('op', 6);

  $.ajax({
    url: "src/controller/controllerReserva.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(function(msg) {
    console.log("Response from server:", msg);
    let obj = JSON.parse(msg);
    if (obj.flag) {
      alerta("Sucesso", obj.msg, "success");
      listaReservas(); // atualiza a lista já sem a reserva que acabou de ser removida
    } else {
      alerta("Erro", obj.msg, "error");
    }
  })
  .fail(function(jqXHR, textStatus) {
    alert("Erro! " + textStatus);
  });
}

// PEDIDO

function registaPedido() {
  let dados = new FormData();
  dados.append('idReserva', $('#idReservaPedido').val());
  dados.append('idEstado', $('#idEstadoPedido').val());
  dados.append('idPrato', $('#idPratoCozinha').val());
  dados.append('op', 1);

  $.ajax({
    url: "src/controller/controllerPedido.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(function( msg ) {     
    alerta("Sucesso", msg, "success");
  })
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getReservas(){

  let dados = new FormData();
  dados.append('op', 7);


  $.ajax({
    url: "src/controller/controllerReserva.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#idReservaPedido').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getMesas(){

  let dados = new FormData();
  dados.append('op', 2);


  $.ajax({
    url: "src/controller/controllerPedido.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   //$('#idMesaPedido').html(msg);
   $('#idMesaReserva').html(msg);

  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getEstadosPedido(){

  let dados = new FormData();
  dados.append('op', 3);

  $.ajax({
    url: "src/controller/controllerPedido.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#idEstadoPedido').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getPratos(){

  let dados = new FormData();
  dados.append('op', 1);


  $.ajax({
    url: "src/controller/controllerPrato.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   //$('#idPratoReserva').html(msg);
   $('#idPratoCozinha').html(msg);

  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function listaPedidos(){

  if ($.fn.DataTable.isDataTable('#listagemPedidos')) {
    $('#listagemPedidos').DataTable().destroy();
}

  let dados = new FormData();
  dados.append ('op', 4);
 
  $.ajax({
  url: "src/controller/controllerPedido.php",
  method: "POST",
  data: dados,
  dataType: "html",
  cache: false,
  contentType: false,
  processData: false
  })
  .done(function( msg ) {
      $('#listaPedidos').html(msg);
      $('#listagemPedidos').DataTable();
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
new DataTable('#listagemPratos', {
  layout: {
      topStart: 'search',
      topEnd: null
  }
});
new DataTable('#listagemReservas', {
  layout: {
      topStart: 'search',
      topEnd: null
  }
});
new DataTable('#listagemPedidos', {
  layout: {
      topStart: 'search',
      topEnd: null
  }
});

// Shorthand for $( document ).ready()
$(function() {
  getSelectTipoCliente();
  listaClientes();
  //listaPratos();
  //getSelectTipoPrato();
  //getEstadosPedido();
  //getMesas();
  //getEstadosReserva();
  //getPratos(); //apenas para registar na tabela cozinha
  //getClientes();
  //getReservas();
  //listaReservas();
  //listaPedidos();
});
