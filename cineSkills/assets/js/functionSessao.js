function registarSessao(){

    let dados = new FormData();
    dados.append ("filme_id", $('#filmeSelectSessao').val());
    dados.append ("sala_sessao", $('#salaSelectSessao').val());
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
        $('#').val(obj.filme_id);
        $('#').val(obj.sala_sessao);
        $('#').val(obj.data);
        $('#').val(obj.hora);
        $('#').val(obj.estado_id);
        $('#btnGuardarSessao').attr("onclick", 'gravarEdicaoSessao(' + id + ')');
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function gravarEdicaoSessao(){

    let dados = new FormData();
    dados.append ("filme_id", $('#nomeFilmeEdit').val());
    dados.append ("sala_sessao", $('#salaSelectSessaoEdit').val());
    dados.append ("data", $('#anoFilmeEdit').val());
    dados.append ("hora", $('#descricaoFilmeEdit').val());
    dados.append ("estado_id", $('#tipoFilmeSelectEdit').val());
    dados.append ("id", $('#selectFilme').val());
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

function getFilmeSessao(){

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
   $('#filmeSelectSessao').html(msg); 
   $('#filmeSelectSessaoEdit').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

function getFilme(){

  let dados = new FormData();
  dados.append('op', 7);


  $.ajax({
    url: "assets/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#selectFilmeSessao').html(msg);     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}  

$(function() {
    listarSessoes();
    getFilmeSessao();
    getFilme();
});

