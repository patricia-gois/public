function registaEmprestimo(){

    let dados = new FormData();
    dados.append ("id_livro", $('#livroEmprestimo').val());
    dados.append ("data_registo", $('#dataRegistoEmprestimo').val());
    dados.append ("data_entrega", $('#dataEntregaEmprestimo').val());
    dados.append ("id_utilizador", $('#utilizadorEmprestimo').val());
    dados.append ("id_socio", $('#socioEmprestimo').val());
    dados.append ('op', 1);

    $.ajax({
    url: "assets/controller/controllerEmprestimo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alerta("Success", msg, "success");
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getLivro(){
    let dados = new FormData();
    dados.append('op', 2);
  
  
    $.ajax({
      url: "assets/controller/controllerEmprestimo.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData:false,
    })
    
    .done(function( msg ) {
        $('#livroEmprestimo').html(msg); 
        $('#livroEmprestimoEdit').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
  }

  function listaEmprestimos(){

    let dados = new FormData();
    dados.append ('op', 3);
   
    $.ajax({
    url: "assets/controller/controllerEmprestimo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        //listaLivrosDropdown();
        $('#listaEmprestimos').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function removerEmprestimo(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 4);
   
    $.ajax({
    url: "assets/controller/controllerEmprestimo.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alerta("Success", msg, "success");
        listaEmprestimos();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getEmprestimo(){
    let dados = new FormData();
    dados.append('op', 5);

    $.ajax({
      url: "assets/controller/controllerEmprestimo.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData:false,
    })
    
    .done(function(msg) {
        $('#selectEmprestimo').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
  }

  function getInfoEmprestimo(id) {
    let dados = new FormData();
    dados.append('id', id);
    dados.append('op', 6);

    $.ajax({
        url: "assets/controller/controllerColaboradores.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(msg) {
        let obj = JSON.parse(msg);
        $('#livroEmprestimoEdit').val(obj.id_livro);
        $('#dataRegistoEmprestimoEdit').val(obj.data_registo);
        $('#dataEntregaEmprestimoEdit').val(obj.data_entrega);
        $('#utilizadorEmprestimoEdit').val(obj.id_utilizador);
        $('#socioEmprestimoEdit').val(obj.id_socio);

        $('#btnGuardarEmprestimo').attr("onclick", 'guardaEditEmprestimo('+id+')');
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

$(function() {
    getLivro();
    getSocios();
    getColaborador();
    listaEmprestimos();
    getEmprestimo();
});

