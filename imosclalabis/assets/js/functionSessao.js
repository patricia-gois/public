function registarSessao(){

    let dados = new FormData();
    dados.append ("filme_id", $('#selectFilmeSessao').val());
    dados.append ("sala_id", $('#salaSelectSessao').val());
    dados.append ("data_sessao", $('#dataSessao').val());
    dados.append ("hora", $('#horaSessao').val());
    dados.append ("estado_id", $('#estadoSelect').val());
    dados.append ('op', 1);
   

    $.ajax({
    url: "assets/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        listarSessoes();
        getFilmeParaSessao();
      })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function listarSessoes(){

    let dados = new FormData();
    dados.append ('op', 2);
   
    $.ajax({
    url: "assets/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#listaSessoes').html(msg);

    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerSessao(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 3);
   
    $.ajax({
    url: "assets/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        listarSessao();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getInfoSessao(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 4);
   
    $.ajax({
    url: "assets/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        let obj = JSON.parse(msg);
        $('#filmeSelectEdit').val(obj.filme_id);
        $('#salaSelectEdit').val(obj.sala_id);
        $('#dataSessaoEdit').val(obj.data_sessao);
        $('#horaSessaoEdit').val(obj.hora);
        $('#estadoSelectEdit').val(obj.estado_id);
        $('#btnGuardarSessao').attr("onclick", 'gravarEdicaoSessao('+id+')');
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function gravarEdicaoSessao(){

    let dados = new FormData();
    dados.append ("filme_id", $('#filmeSelectEdit').val());
    dados.append ("sala_id", $('#salaSelectEdit').val());
    dados.append ("data_sessao", $('#dataSessaoEdit').val());
    dados.append ("hora", $('#horaSessaoEdit').val());
    dados.append ("estado_id", $('#estadoSelectEdit').val());
    dados.append ("id", $('#selectSessao').val());
    dados.append ('op', 5);
   

    $.ajax({
    url: "assets/controller/controllerSessao.php",
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

function getFilmeParaSessao(){

  let dados = new FormData();
  dados.append('op', 6);


  $.ajax({
    url: "assets/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#selectFilmeSessao').html(msg); 
   $('#filmeSelectEdit').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getSalaParaSessao(){

  let dados = new FormData();
  dados.append('op', 7);


  $.ajax({
    url: "assets/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#salaSelectSessao').html(msg); 
   $('#salaSelectEdit').html(msg);    
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getEstado(){

  let dados = new FormData();
  dados.append('op', 8);


  $.ajax({
    url: "assets/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#estadoSelect').html(msg); 
   $('#estadoSelectEdit').html(msg);    
  })

  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getSessao(){

  let dados = new FormData();
  dados.append('op', 9);

  $.ajax({
    url: "assets/controller/controllerSessao.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#selectSessao').html(msg);
  })

  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

$(function() {
    listarSessoes();
    getFilmeParaSessao();
    getSalaParaSessao();
    getEstado();
    getSessao();
});

