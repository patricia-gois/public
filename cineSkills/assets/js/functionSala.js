function registarSala(){

    let dados = new FormData();
    dados.append ("descricao", $('#descricaoSala').val());
    dados.append ("cinema_id", $('#selectCinemaParaSala').val());
    dados.append ('op', 1);
   

    $.ajax({
    url: "assets/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        listarSalas();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function listarSalas(){

    let dados = new FormData();
    dados.append ('op', 2);
   
    $.ajax({
    url: "assets/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#listaSalas').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerSala(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 3);
   
    $.ajax({
    url: "assets/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alert(msg);
        listarSalas();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getInfoSala(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 4);
   
    $.ajax({
    url: "assets/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        let obj = JSON.parse(msg);
        $('#descricaoSalaEdit').val(obj.descricao);
        $('#selectCinemaParaSalaEdit').val(obj.cinema_id);
        $('#btnGuardar').attr("onclick", 'guardaEdit('+id+')');
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function gravarEdicaoSala(){

    let dados = new FormData();
    dados.append ("descricao", $('#descricaoSalaEdit').val());
    dados.append ("cinema_id", $('#selectCinemaParaSalaEdit').val());
    dados.append ("id", $('#selectSala').val());
    dados.append ('op', 5);
   

    $.ajax({
    url: "assets/controller/controllerSala.php",
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

function getSala(){

  let dados = new FormData();
  dados.append('op', 6);


  $.ajax({
    url: "assets/controller/controllerSala.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
  })
  
  .done(function( msg ) {
   $('#selectSala').html(msg);
  })
  
  .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
  });
}

$(function() {
    listarSalas();
    getSala();
});

