<?php

require_once 'connection.php';

class Colaborador {

    // Function to register a new collaborator
    function registaColaborador($nome, $morada, $telefone, $email, $numfunc, $numcc, $datanasc, $id_tipo) {
        global $conn;
        $flag = true;
        $msg = "";
    
        // Verifies if the phone number has more than 9 digits
        if (strlen($telefone) > 9 || strlen($telefone) < 9) {
        $flag = false;
        $msg = "Erro: O número de telefone tem de ter exatamente 9 dígitos.";
        return json_encode(array(
            "success" => $flag,
            "msg" => $msg
        ));
    }

    // Verifies if birth date is valid and if the user is at least 18 years old
    $dataNascimento = new DateTime($datanasc);
    $dataAtual = new DateTime();
    $idade = $dataAtual->diff($dataNascimento)->y; // Calcular idade

    if ($idade < 18) {
        // If age less than 18, return an error
        $flag = false;
        $msg = "Erro: O colaborador deve ter pelo menos 18 anos.";
        return json_encode(array(
            "success" => $flag,
            "msg" => $msg
        ));
    }

        // Validate if the id_tipo exists in the tipo_utilizador table
        $stmt_tipo = $conn->prepare("SELECT id FROM tipo_utilizador WHERE id = ?");
        $stmt_tipo->bind_param("i", $id_tipo);
        $stmt_tipo->execute();
        $stmt_tipo->store_result();
    
        if ($stmt_tipo->num_rows == 0) {
            // If the id_tipo does not exist, return an error
            $flag = false;
            $msg = "Erro: O tipo de utilizador não é válido.";
            $stmt_tipo->close();
        } else {
            // If id_tipo is valid, proceed with the insert
            $flag = true;
            $stmt = $conn->prepare("INSERT INTO collaborators (nome, morada, telefone, email, numfunc, numcc, datanasc, id_tipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssiss", $nome, $morada, $telefone, $email, $numfunc, $numcc, $datanasc, $id_tipo);
    
            // Execute the insert query
            if ($stmt->execute()) {
                $msg = "Registo efetuado com sucesso.";
            } else {
                $flag = false;
                $msg = $stmt->error;
            }

            $stmt->close();
        }
    
        return json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

        $conn->close();
    }

    function getTiposFunc() {
        global $conn;
        $msg = "<option selected>Selecione um tipo</option>";
    
        $sql = "SELECT id, descricao FROM tipo_utilizador";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='" . $row['id'] . "'>" . $row['descricao'] . "</option>";
            }
        } else {
    
            $msg = "<option value=''>Sem tipos registados</option>";
        }
    
        $conn->close();
        return $msg;
    }

    function getColaborador(){
        global $conn;
        $msg = "<option selected'>Selecione um colaborador</option>";
        $sql = "SELECT * FROM collaborators";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['id']."'>". $row['numfunc']." - ".$row['nome']."</option>";
            }
        } else {
            $msg = "<option value='-1'>Sem colaboradores registados</option>";
        }
        return $msg;
    }

    function removerColaborador($id){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM collaborators WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return($msg);
    }

    function listaColaboradores(){

        global $conn;

        $msg = "";
        $sql = "SELECT collaborators.*, tipo_utilizador.descricao AS tipo_descricao
                FROM collaborators 
                JOIN tipo_utilizador ON collaborators.id_tipo = tipo_utilizador.id;
                ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['id']."</td>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['numfunc']."</td>";
                $msg .= "<td>".$row['numcc']."</td>";
                $msg .= "<td>".$row['datanasc']."</td>";
                $msg .= "<td>".$row['tipo_descricao']."</td>";
                //$msg .= "<td><button type'button' class='btn btn-info' onclick='getInfoColaborador(".$row['id'].")'>Visualizar ficha</button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick='removerColaborador(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "Sem resultados";
        }
        $conn->close();

        return ($msg);
    }

    function getInfoColaborador($id){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT collaborators.* FROM collaborators WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }
    
    function guardaEditColaborador($id, $nome, $morada, $telefone, $email, $numfunc, $numcc, $datanasc, $id_tipo) {
        global $conn;
        $msg = "";
        $flag = true;
    
        // Prepare the statement to update the book details
        $stmt = $conn->prepare("UPDATE collaborators SET nome = ?, morada = ?, telefone = ?, email = ?, numfunc = ?, numcc = ?, datanasc = ?, id_tipo = ? WHERE id = ?");
        $stmt->bind_param("sssssisii", $nome, $morada, $telefone, $email, $numfunc, $numcc, $datanasc, $id_tipo, $id);
    
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

        $conn->close();
    }
    
}

?>

