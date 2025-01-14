
// function setMinDateFor18YearsOld() {
//     const today = new Date();
//     const minDate = new Date();
//     minDate.setFullYear(today.getFullYear() - 18);

//     const yyyy = minDate.getFullYear();
//     const mm = String(minDate.getMonth() + 1).padStart(2, '0');
//     const dd = String(minDate.getDate()).padStart(2, '0');
//     const formattedMinDate = `${yyyy}-${mm}-${dd}`;

//     const dataNascFuncInput = document.getElementById('dataNascFunc');
//     if (dataNascFuncInput) {
//         dataNascFuncInput.min = formattedMinDate;
//     } else {
//         console.error("Elemento com o ID 'dataNascFunc' não foi encontrado no DOM.");
//     }
// }

function validateDate() {
    const dataNascFuncInput = document.getElementById('dataNascFunc');
    const errorMessageDiv = document.getElementById('error-message');
    const selectedDate = new Date(dataNascFuncInput.value);
    const today = new Date();
    
    // Calcular a data de 18 anos atrás
    const minDate = new Date();
    minDate.setFullYear(today.getFullYear() - 18);

    if (selectedDate > minDate) {
        // Se a data selecionada for maior que 18 anos atrás
        errorMessageDiv.textContent = "Atenção: deverá ter mais de 18 anos.";
        errorMessageDiv.style.display = "block"; // Exibe a mensagem de erro
    } else {
        // Se a data estiver dentro do limite
        errorMessageDiv.textContent = "";
        errorMessageDiv.style.display = "none"; // Esconde a mensagem de erro
    }
    
}
function registaColaborador() {
    let dados = new FormData();
    dados.append("nome", $('#nomeFunc').val());
    dados.append("morada", $('#moradaFunc').val());
    dados.append("telefone", $('#telefoneFunc').val());
    dados.append("email", $('#emailFunc').val());
    dados.append("numfunc", $('#numFunc').val());
    dados.append("numcc", $('#numccFunc').val()); //new field
    dados.append("datanasc", $('#dataNascFunc').val());
    dados.append("id_tipo", $('#tipoFunc').val());
    dados.append('op', 1);

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
        let parsedResposta = JSON.parse(msg);
        if (parsedResposta.flag){
            alerta("Success", parsedResposta.msg, "success");
            // listaColaboradores();
        }else{
            alerta("Error", parsedResposta.msg, "error");
        }
        
    })
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    })
}

function getTiposFunc(){
    let dados = new FormData();
    dados.append('op', 7);
  
  
    $.ajax({
      url: "assets/controller/controllerColaboradores.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData:false,
    })
    
    .done(function( msg ) {
     $('#tipoFunc').html(msg);     
     $('#tipoFuncEdit').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
  }

function getColaborador(){
let dados = new FormData();
dados.append('op', 8);


$.ajax({
    url: "assets/controller/controllerColaboradores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData:false,
})

.done(function( msg ) {
    $('#selectColaborador').html(msg);
    $('#utilizadorEmprestimo').html(msg);
    $('#utilizadorEmprestimoEdit').html(msg);
})

.fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
});
}


function listaColaboradores(){

    let dados = new FormData();
    dados.append ('op', 2);
   
    $.ajax({
    url: "assets/controller/controllerColaboradores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#listaColaboradores').html(msg);
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function getInfoColaborador(id) {
    let dados = new FormData();
    dados.append('id', id);
    dados.append('op', 3);  // fetches the user info based on the user ID

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
        $('#nomeFuncEdit').val(obj.nome);
        $('#moradaFuncEdit').val(obj.morada);
        $('#telefoneFuncEdit').val(obj.telefone);
        $('#emailFuncEdit').val(obj.email);
        $('#numFuncEdit').val(obj.numfunc);
        $('#numccFuncEdit').val(obj.numcc);
        $('#dataNascFuncEdit').val(obj.datanasc);
        $('#tipoFuncEdit').val(obj.id_tipo);

        $('#numccFuncEditContainer').hide();

        $('#btnGuardarColaborador').attr("onclick", 'guardaEditColaborador('+id+')');
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function toggleNumCC() {
    const numCCInputContainer = $('#numccFuncEditContainer');
    const asteriscos = $('#asteriscos');
    if (numCCInputContainer.is(':visible')) {
        numCCInputContainer.hide();  // Esconde o campo
        asteriscos.show();
    } else {
        numCCInputContainer.show();  // Mostra o campo
        asteriscos.hide();
    }
}

function removerColaborador(id){

    let dados = new FormData();
    dados.append ('id', id);
    dados.append ('op', 6);
   
    $.ajax({
    url: "assets/controller/controllerColaboradores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        alerta("Success", msg, "success"); // Use SweetAlert instead of alert
        listaColaboradores();
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function guardaEditColaborador(id) {
    let dados = new FormData();
    dados.append("id", id); 
    dados.append("nome", $('#nomeFuncEdit').val());
    dados.append("morada", $('#moradaFuncEdit').val());
    dados.append("telefone", $('#telefoneFuncEdit').val());
    dados.append("email", $('#emailFuncEdit').val());
    dados.append("numfunc", $('#numFuncEdit').val());
    dados.append("numcc", $('#numccFuncEdit').val()); //new field
    dados.append("datanasc", $('#dataNascFuncEdit').val());
    dados.append("id_tipo", $('#tipoFuncEdit').val());
    
    dados.append('op', 5);  

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
        getTiposFunc();
        alerta("Success", msg, "success"); 
        listaColaboradores(); 
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

  function contagemColaboradores(){

    let dados = new FormData();
    dados.append ('op', 8);
   
    $.ajax({
    url: "assets/controller/controllerColaboradores.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    .done(function( msg ) {
        $('#totalColaboradores').html(msg);
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
  new DataTable('#listagemColaboradores', {
    layout: {
        topStart: 'search',
        topEnd: null
    }
  });

$(function() {
    // setMinDateFor18YearsOld();
    listaColaboradores();
    getTiposFunc();
    getColaborador();
});

