<?php

require_once 'connection.php';

class Livro {


    // Method to check if ISBN already exists in the database
    function checkIsbnExists($isbn) {
        global $conn;

        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM livros WHERE isbn = ?");
        $stmt->bind_param("s", $isbn);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();

        return $row['total'] > 0; // Return true if ISBN exists, false otherwise
    }

    function registaLivro($titulo, $isbn, $sinopse, $qtd, $datalanc, $edicao, $editora, $idioma, $qtdpaginas, $estado) {
        global $conn;
        $msg = "";
        $flag = true;

        // Check if the ISBN already exists
        if ($this->checkIsbnExists($isbn)) {
            $flag = false;
            $msg = "Este ISBN já existe no sistema. Por favor submeta um diferente."; // Return error message if ISBN exists
        } else {
            // Prepare statement for inserting the new book record
            $stmt = $conn->prepare("INSERT INTO livros (titulo, isbn, sinopse, qtd, datalanc, edicao, editora, idioma, qtdpaginas, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssisissii", $titulo, $isbn, $sinopse, $qtd, $datalanc, $edicao, $editora, $idioma, $qtdpaginas, $estado);

            // Execute the insert query
            if ($stmt->execute()) {
                $msg = "Registo efetuado com sucesso.";
            } else {
                $flag = false;
                $msg = $stmt->error; // Capture any SQL errors
            }

            $stmt->close();
        }

        // Return response as JSON
        return json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

        $conn->close();
    }

    function removerLivro($id){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM livros WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return($msg);
    }

    function listaLivros(){

        global $conn;

        $msg = "";
        $sql = "SELECT * FROM livros";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['id']."</td>";
                $msg .= "<td>".$row['titulo']."</td>";
                $msg .= "<td>".$row['isbn']."</td>";
                $msg .= "<td>".$row['sinopse']."</td>";
                $msg .= "<td>".$row['qtd']."</td>";
                $msg .= "<td>".$row['datalanc']."</td>";
                $msg .= "<td>".$row['edicao']."</td>";
                $msg .= "<td>".$row['editora']."</td>";
                $msg .= "<td>".$row['idioma']."</td>";
                $msg .= "<td>".$row['qtdpaginas']."</td>";
                $msg .= "<td>".$row['estado']."</td>";
                $msg .= "<td><button class='btn btn-danger' onclick='removerLivro(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";
                //$msg .= "<td><button class='btn btn-warning' onclick='getInfoLivro(".$row['id'].")'><i class='fa fa-pencil'></i></button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "Sem resultados";
        }
        $conn->close();

        return ($msg);
    }

    function getInfoLivro($id){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM livros WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }
    
    function guardaEditLivro($id, $titulo, $isbn, $sinopse, $qtd, $datalanc, $edicao, $editora, $idioma, $qtdpaginas, $estado) {
        global $conn;
        $msg = "";
        $flag = true;
    
        // Prepare the statement to update the book details
        $stmt = $conn->prepare("UPDATE livros SET titulo = ?, isbn = ?, sinopse = ?, qtd = ?, datalanc = ?, edicao = ?, editora = ?, idioma = ?, qtdpaginas = ?, estado = ? WHERE id = ?");
        $stmt->bind_param("sssisissiii", $titulo, $isbn, $sinopse, $qtd, $datalanc, $edicao, $editora, $idioma, $qtdpaginas, $estado, $id);
    
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

    function listaLivrosDropdown() {
        global $conn;
        $msg = "<option value=''>Selecione um livro</option>";
    
        $sql = "SELECT id, titulo FROM livros";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='" . $row['id'] . "'>" . $row['titulo'] . "</option>";
            }
        } else {
            $msg = "<option value=''>Sem livros disponíveis</option>";
        }
    
        $conn->close();
        return $msg;
    }
}

?>