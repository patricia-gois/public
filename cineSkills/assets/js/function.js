function registaLocalidade(){

  let dados = new FormData();
  dados.append ("descricao", $('#descricaoLocal').val());
  dados.append ('op', 8);
 

  $.ajax({
  url: "assets/controller/controllerCinema.php",
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

function registaCinema(){

    let dados = new FormData();
    dados.append ("nome", $('#nomeCinema').val());
    dados.append ("local_id", $('#localSelect').val());
    dados.append ('op', 1);
   

    $.ajax({
    url: "assets/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        listaCinemas();
        getLocalidade();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function listaCinemas(){

    let dados = new FormData();
    dados.append ('op', 2);
   
    $.ajax({
    url: "assets/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#listaCinemas').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerCinema(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 3);
   
    $.ajax({
    url: "assets/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        listaCinemas();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getCinema(){

    let dados = new FormData();
    dados.append('op', 7);
  
  
    $.ajax({
      url: "assets/controller/controllerCinema.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData:false,
    })
    
    .done(function( msg ) {
     $('#selectCinema').html(msg);     
     $('#selectCinemaParaSala').html(msg);
     $('#selectCinemaParaSalaEdit').html(msg);

    })
    
    .fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
  }

function getInfoCinema(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 4);
   
    $.ajax({
    url: "assets/controller/controllerCinema.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        let obj = JSON.parse(msg);
        $('#editNomeCinema').val(obj.nome);
        $('#editLocalSelect').val(obj.local_id);
        $('#btnGuardarCinema').attr("onclick", 'gravarEdicaoCinema('+id+')');
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function gravarEdicaoCinema(){

    let dados = new FormData();
    dados.append ("nome", $('#editNomeCinema').val());
    dados.append ("local_id", $('#editLocalSelect').val());
    dados.append ("id", $('#selectCinema').val());
    dados.append ('op', 5);
   

    $.ajax({
    url: "assets/controller/controllerCinema.php",
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

function getLocalidade(){

    let dados = new FormData();
    dados.append('op', 6);
  
  
    $.ajax({
      url: "assets/controller/controllerCinema.php",
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

$(function() {
    listaCinemas();
    getLocalidade();
    getCinema();
});

