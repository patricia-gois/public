<?php

require_once 'connection.php';

class Cliente {

    function newClient($nif, $nome, $morada, $email, $telefone, $estado) {
        global $conn;
        $msg = "";
        $flag = true;
    
        // Prepare statement
        $stmt = $conn->prepare("INSERT INTO cliente (nif, nome, morada, email, telefone, estado) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nif, $nome, $morada, $email, $telefone, $estado);
    
        // Execute statement
        if ($stmt->execute()) {
            $flag = true;
            $msg = "Registo efetuado com sucesso.";
        } else {
            $flag = false;
            $msg = $stmt->error; //send error alert to technical system
        }
    
        $stmt->close();
        $conn->close();
    
        // Return response as JSON
        echo json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
    }

    function getInfoClient($nif) {
        global $conn;
        $msg = "";
        $row = "";
    
        // Prepare and bind
        $stmt = $conn->prepare("SELECT * FROM cliente WHERE nif = ?");
        $stmt->bind_param("s", $nif);
    
        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Fetch data
            $row = $result->fetch_assoc();
        }
    
        // Close the statement
        $stmt->close();
    
        // Return result as JSON
        return json_encode($row);
    }
    
    
    function saveEditClient($oldNif, $nome, $morada, $email, $telefone, $estado, $nif) {
        global $conn;
        $msg = "";
        $flag = true;
    
        // Prepare the statement to update the book details
        $stmt = $conn->prepare("UPDATE cliente SET oldNif = ?, nome = ?, morada = ?, email = ?, telefone = ?, estado = ? WHERE nif = oldNif");
        $stmt->bind_param("sssssss", $oldNif, $nome, $morada, $email, $telefone, $estado, $nif);
    
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
    
    function listClients(){

        global $conn;

        $msg = "";
        $sql = "SELECT * FROM cliente;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['nif']."</td>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['estado']."</td>";
                // Convert estado value to descriptive text
                // $estado_descricao = ($row['estado'] == 0) ? "Ativo" : "Inativo";
                // $msg .= "<td>".$estado_descricao."</td>";
                //$msg .= "<td><button type'button' class='btn btn-info' onclick='getInfoColaborador(".$row['id'].")'>Visualizar ficha</button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick='removeClient(".$row['nif'].")'><i class='fa fa-trash'></i></button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "Sem resultados";
        }
        $conn->close();

        return ($msg);
    }

    function removeClient($nif){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM cliente WHERE nif = ".$nif;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return($msg);
    }
    
}

?>