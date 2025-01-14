function registarFilme(){

    let dados = new FormData();
    dados.append ("nome", $('#nomeFilme').val());
    dados.append ("ano", $('#anoFilme').val());
    dados.append ("descricao", $('#descricaoFilme').val());
    dados.append ("tipo_filme_id", $('#tipoFilmeSelect').val());
    dados.append ('op', 1);
   

    $.ajax({
    url: "assets/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        listarFilmes();
        contagemFilmes();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function listarFilmes(){

    let dados = new FormData();
    dados.append ('op', 2);
   
    $.ajax({
    url: "assets/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#listaFilmes').html(msg);

    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerFilme(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 3);
   
    $.ajax({
    url: "assets/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        listarFilmes();
        contagemFilmes();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getInfoFilme(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 4);
   
    $.ajax({
    url: "assets/controller/controllerFilme.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        let obj = JSON.parse(msg);
        $('#nomeFilmeEdit').val(obj.nome);
        $('#anoFilmeEdit').val(obj.ano);
        $('#descricaoFilmeEdit').val(obj.descricao);
        $('#tipoFilmeSelectEdit').val(obj.tipo);
        $('#btnGuardarFilme').attr("onclick", 'gravarEdicaoFilme(' + id + ')');
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function gravarEdicaoFilme(){

    let dados = new FormData();
    dados.append ("nome", $('#nomeFilmeEdit').val());
    dados.append ("ano", $('#anoFilmeEdit').val());
    dados.append ("descricao", $('#descricaoFilmeEdit').val());
    dados.append ("tipo_filme_id", $('#tipoFilmeSelectEdit').val());
    dados.append ("id", $('#selectFilme').val());
    dados.append ('op', 5);
   

    $.ajax({
    url: "assets/controller/controllerFilme.php",
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

function getTipoFilme(){

  let dados = new FormData();
  dados.append('op', 6);


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
   $('#tipoFilmeSelect').html(msg); 
   $('#tipoFilmeSelectEdit').html(msg);
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
   $('#selectFilme').html(msg);     
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}  

function contagemFilmes(){

  let dados = new FormData();
  dados.append ('op', 8);
 
  $.ajax({
  url: "assets/controller/controllerFilme.php",
  method: "POST",
  data: dados,
  dataType: "html",
  cache: false,
  contentType: false,
  processData: false
  })
  .done(function( msg ) {
      $('#totalFilmes').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
  alert( "Request failed: " + textStatus );
  });
}


$(function() {
    listarFilmes();
    getTipoFilme();
    getFilme();
    contagemFilmes();
});

