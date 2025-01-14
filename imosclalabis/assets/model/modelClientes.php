<?php

require_once 'connection.php';

class Cliente{

    function registaCliente($nif, $nome, $email, $telefone, $morada, $cod_postal, $localizacao_id){

        global $conn;
        $msg = "";

        $sql = "INSERT INTO cliente (nome, email, telefone, morada, cod_postal, localizacao_id) VALUES ('".$nif."','".$nome."','".$email."','".$telefone."','".$morada."','".$cod_postal."','".$localizacao_id."')";
        
        if ($conn->query($sql) === TRUE) {
          $msg = "Cliente registado com sucesso!";
        } else {
          $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();

        return ($msg);
    }

    function listaClientes(){

        global $conn;

        $msg = "";
        $sql = "SELECT cliente.*, localizacao.descricao FROM cliente, localizacao WHERE localizacao.id = cliente.localizacao_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['nif']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removeCliente(".$row['nif'].")'>Remover</button></td>";
                //$msg .= "<td><button type='button' onclick='editarCinema(".$row['id'].")'>Editar</button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "0 results";
        }
        $conn->close();

        return ($msg);
    }

    function removeCinema($id){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM cinema WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return($msg);
    }

    function getInfoCinema($id){

        global $conn;
        $row = "";

        $msg = "";
        $sql = "SELECT * FROM cinema WHERE id = ".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();           
        }

        $conn->close();

        return (json_encode($row));
    }

    function gravarEdicaoCinema($nome, $local_id, $id){
        global $conn;
        $msg = "";

        $sql = "UPDATE cinema SET nome = '".$nome."', local_id ='".$local_id."' WHERE id=".$id;

        if ($conn->query($sql) === TRUE) {
          $msg = "Cliente editado com sucesso";
        } else {
          $msg = "Error updating record: " . $conn->error;
        }
        
        $conn->close();

        return ($msg);
    }


    function getCinema(){
        global $conn;
        $msg = "<option value = '-1'>Escolha um cinema</option>";

        $sql = "SELECT * FROM cinema";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['nome']."</option>";
        }
        } else {
            $msg .= "<option value = '-1'>Sem cinemas registados</option>";
        }
        $conn->close();
        
        return $msg;
    }

    function getLocal(){
        global $conn;
        $msg = "<option value = '-1'>Escolha uma localidade</option>";

        $sql = "SELECT * FROM localidade";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
        }
        } else {
            $msg .= "<option value = '-1'>Sem locais registados</option>";
        }
        $conn->close();
        
        return $msg;
    }

    function contagemCinemas(){
        global $conn;        
        $sql = "SELECT COUNT(*) as total_cinemas FROM cinema";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Obtém a linha com o resultado
            $row = $result->fetch_assoc();
            echo $row['total_cinemas'];
        } else {
            echo "0";
        }
        $conn->close();
    }
}
    

?>