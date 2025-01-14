<?php

require_once 'connection.php';

class Evento {

    function registaEvento($id_organizador, $descricao, $localidade, $titulo, $data_inicio, $data_fim, $facebook, $instagram, $tiktok) {
        global $conn;
        $msg = "";
        $flag = true;

        $stmt = $conn->prepare("INSERT INTO evento (id_organizador, descricao, localidade, titulo, data_inicio, data_fim, facebook, instagram, tiktok) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $id_organizador, $descricao, $localidade, $titulo, $data_inicio, $data_fim, $facebook, $instagram, $tiktok);

        // Execute the insert query
        if ($stmt->execute()) {
            $msg = "Registo efetuado com sucesso.";
        } else {
            $flag = false;
            $msg = $stmt->error; // Capture any SQL errors
        }

        $stmt->close();

        // Return response as JSON
        return json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

        $conn->close();
    }

    function removerEvento($id){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM evento WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return($msg);
    }

    function listaEventos(){

        global $conn;

        $msg = "";
        $sql = "SELECT * FROM evento";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['id']."</td>";
                $msg .= "<td>".$row['id_organizador']."</td>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "<td>".$row['localidade']."</td>";
                $msg .= "<td>".$row['titulo']."</td>";
                $msg .= "<td>".$row['data_inicio']."</td>";
                $msg .= "<td>".$row['data_fim']."</td>";
                $msg .= "<td>".$row['facebook']."</td>";
                $msg .= "<td>".$row['instagram']."</td>";
                $msg .= "<td>".$row['tiktok']."</td>";
                $msg .= "<td><button class='btn btn-danger' onclick='removerEvento(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "Sem resultados";
        }
        $conn->close();

        return ($msg);
    }

    function getInfoEvento($id){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM evento WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }
    
    function guardaEditEvento($id, $id_organizador, $descricao, $localidade, $titulo, $data_inicio, $data_fim, $facebook, $instagram, $tiktok) {
        global $conn;
        $msg = "";
        $flag = true;
    
        // Prepare the statement to update the book details
        $stmt = $conn->prepare("UPDATE evento SET id_organizador = ?, descricao = ?, localidade = ?, titulo = ?, data_inicio = ?, data_fim = ?, facebook = ?, instagram = ?, tiktok = ? WHERE id = ?");
        $stmt->bind_param("sssssssssi", $id_organizador, $descricao, $localidade, $titulo, $data_inicio, $data_fim, $facebook, $instagram, $tiktok, $id);
    
        if ($stmt->execute()) {
            // If the update is successful
            $msg = "Editado com sucesso";
        } else {
            $flag = false;
            $msg = "Erro: " . $stmt->error;
        }
    
        $stmt->close();
    
        // Return response as JSON
        return json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
    }    

    function getOrganizadores() {
        global $conn;
        $msg = "<option value=''>Selecione um organizador</option>";
    
        $sql = "SELECT nif, nome FROM organizador";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='" . $row['nif'] . "'>" . $row['nome'] . "</option>";
            }
        } else {
            $msg = "<option value=''>Sem organizadores disponíveis</option>";
        }
    
        $conn->close();
        return $msg;
    }

    function getEventos() {
        global $conn;
        $msg = "<option value=''>Selecione um evento</option>";
    
        $sql = "SELECT id, titulo FROM evento";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='" . $row['id'] . "'>" . $row['titulo'] . "</option>";
            }
        } else {
            $msg = "<option value=''>Sem eventos disponíveis</option>";
        }
    
        $conn->close();
        return $msg;
    }
    
}

?>