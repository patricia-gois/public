<?php

require_once 'connection.php';

class Cinema{

    function registaLocalidade($descricao){

        global $conn;
        $msg = "";

        $sql = "INSERT INTO local (descricao) VALUES ('".$descricao."')";
        
        if ($conn->query($sql) === TRUE) {
          $msg = "Localidade registada com sucesso!";
        } else {
          $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();

        return ($msg);
    }

    function registarCinema($nome, $local_id){

        global $conn;
        $msg = "";

        $sql = "INSERT INTO cinema (nome, local_id) VALUES ('".$nome."','".$local_id."')";
        
        if ($conn->query($sql) === TRUE) {
          $msg = "Cinema registado com sucesso!";
        } else {
          $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();

        return ($msg);
    }

    function listarCinemas(){

        global $conn;

        $msg = "";
        $sql = "SELECT cinema.*, local.descricao FROM cinema, local WHERE local.id = cinema.local_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerCinema(".$row['id'].")'>Remover</button></td>";
                //$msg .= "<td><button type='button' onclick='editarCinema(".$row['id'].")'>Editar</button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "0 results";
        }
        $conn->close();

        return ($msg);
    }

    function removerCinema($id){

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
          $msg = "Cinema editado com sucesso";
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

    function getLocalidade(){
        global $conn;
        $msg = "<option value = '-1'>Escolha um localidade</option>";

        $sql = "SELECT * FROM local";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
        }
        } else {
            $msg .= "<option value = '-1'>Sem localidades registados</option>";
        }
        $conn->close();
        
        return $msg;
    }

}    

?>