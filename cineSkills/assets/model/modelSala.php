<?php

require_once 'connection.php';

class Sala{

    function registarSala($descricao, $cinema_id) {
        global $conn;
        $msg = "";

        // Using prepared statements to prevent SQL injection
        $sql = $conn->prepare("INSERT INTO sala (descricao, cinema_id) VALUES (?, ?)");
        $sql->bind_param("si", $descricao, $cinema_id);
        
        if ($sql->execute()) {
            $msg = "Sala registada com sucesso!";
        } else {
            $msg = "Error: " . $sql->error;
        }
        
        $sql->close();
        return $msg;
    }

    function listarSalas(){

        global $conn;

        $msg = "";
        $sql = "SELECT sala.*, cinema.nome FROM sala, cinema WHERE cinema.id = sala.cinema_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerSala(".$row['id'].")'>Remover</button></td>";
                //$msg .= "<td><button type='button' onclick='editarSala(".$row['id'].")'>Editar</button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "0 results";
        }
        $conn->close();

        return ($msg);
    }

    function removerSala($id){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM sala WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return($msg);
    }

    function getInfoSala($id){

        global $conn;
        $row = "";

        $msg = "";
        $sql = "SELECT * FROM sala WHERE id = ".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();           
        }

        $conn->close();

        return (json_encode($row));
    }

    function gravarEdicaoSala($descricao, $cinema_id, $id){
        global $conn;
        $msg = "";

        $sql = "UPDATE sala SET descricao = '".$descricao."', cinema_id ='".$cinema_id."' WHERE id=".$id;

        if ($conn->query($sql) === TRUE) {
          $msg = "Sala editada com sucesso";
        } else {
          $msg = "Error updating record: " . $conn->error;
        }
        
        $conn->close();

        return ($msg);
    }

    function getSala(){
        global $conn;
        $msg = "<option value = '-1'>Escolha uma sala</option>";

        $sql = "SELECT * FROM sala";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
        }
        } else {
            $msg .= "<option value = '-1'>Sem salas registadas</option>";
        }
        $conn->close();
        
        return $msg;
    }

}
    

?>