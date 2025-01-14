<?php

require_once 'connection.php';

class Socio {

    function registaSocio($nome, $cc, $numsocio, $morada, $email, $telefone, $datanasc, $estado) {

        global $conn;
        $msg = "";
        $flag = true;

        // Prepare statement
        $stmt = $conn->prepare("INSERT INTO socio (nome, cc, numsocio, morada, email, telefone, datanasc, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", $nome, $cc, $numsocio, $morada, $email, $telefone, $datanasc, $estado);

        // Execute statement
        if ($stmt->execute()) {
            $msg = "Registo efetuado com sucesso.";
        } else {
            $flag = false;
            $msg = $stmt->error; //send error alert to technical system
        }

        $stmt->close();

        return $msg;
        $conn->close();

    }

    function getSocios() {
        global $conn;
        
        // Default option
        $msg = "<option value='-1'>Selecione um sócio</option>";
        
        // Prepare the query
        $sql = "SELECT id, numsocio, nome FROM socio";
        $result = $conn->query($sql);
        
        // Check if the query ran successfully
        if ($result === false) {
            $msg = "<option value='-2'>Erro no carregamento dos sócios</option>";
        } else {
            // Check if rows are returned
            if ($result->num_rows > 0) {
                // Loop through the results and append options
                while ($row = $result->fetch_assoc()) {
                    $msg .= "<option value='" . $row['id'] . "'>" . $row['numsocio'] . " - " . $row['nome'] . "</option>";
                }
            } else {
                // No rows returned
                $msg = "<option value=''>Sem sócios registados</option>";
            }
        }
        
        return $msg;  // Return the complete HTML to be used in the dropdown
    }
    

    // function getSocios() {
    //     global $conn;
    //     $msg = "<option value='-1'>Selecione um sócio</option>";
    //     $sql = "SELECT id, numsocio, nome FROM socio";
    //     $result = $conn->query($sql);
    //     if ($result === false) {
    //         $msg = "<option value='-2'>Erro no carregamento dos sócios</option>";
    //     } else {
    //         if ($result->num_rows > 0) {
    //             while ($row = $result->fetch_assoc()) {
    //                 $msg .= "<option value='".$row['id']."'>".$row['numsocio']." - ".$row['nome']."</option>";
    //             }
    //         } else {
    //             $msg = "<option value=''>Sem sócios registados</option>";
    //         }
    //     }    
    //     return $msg;
    // }
    

    function getInfoSocio($id) {
        global $conn;
        $msg = "";
        $row = "";
    
        // Prepare and bind
        $stmt = $conn->prepare("SELECT * FROM socio WHERE id = ?");
        $stmt->bind_param("i", $id);
    
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
    
    
    function guardaEditSocio($id, $nome, $cc, $numsocio, $morada, $email, $telefone, $datanasc, $estado) {
        global $conn;
        $msg = "";
        $flag = true;
    
        // Prepare the statement to update the book details
        $stmt = $conn->prepare("UPDATE socio SET nome = ?, cc = ?, numsocio = ?, morada = ?, email = ?, telefone = ?, datanasc = ?, estado = ? WHERE id = ?");
        $stmt->bind_param("sssssssii", $nome, $cc, $numsocio, $morada, $email, $telefone, $datanasc, $estado, $id);
    
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
    
    function listaSocios(){

        global $conn;

        $msg = "";
        $sql = "SELECT * FROM socio;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['id']."</td>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['cc']."</td>";
                $msg .= "<td>".$row['numsocio']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['datanasc']."</td>";
                // Convert estado value to descriptive text
                $estado_descricao = ($row['estado'] == 0) ? "Ativo" : "Inativo";
                $msg .= "<td>".$estado_descricao."</td>";
                //$msg .= "<td><button type'button' class='btn btn-info' onclick='getInfoColaborador(".$row['id'].")'>Visualizar ficha</button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick='removerSocio(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "Sem resultados";
        }
        $conn->close();

        return ($msg);
    }

    function removerSocio($id){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM socio WHERE id = ".$id;

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