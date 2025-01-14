<?php

require_once 'connection.php';

class Filme{

    function registarFilme($nome, $ano, $descricao, $tipo_filme_id ){

        global $conn;
        $msg = "";

        $sql = "INSERT INTO filme (nome, ano, descricao, tipo_filme_id) VALUES ('".$nome."','".$ano."','".$descricao."','".$tipo_filme_id."')";
        
        if ($conn->query($sql) === TRUE) {
          $msg = "Filme registado com sucesso!";
        } else {
          $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();

        return ($msg);
    }

    function listarFilmes(){

        global $conn;

        $msg = "";
        $sql = "SELECT filme.*, tipo_filme.descricao AS tipo FROM filme, tipo_filme WHERE tipo_filme.id = filme.tipo_filme_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['ano']."</td>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "<td>".$row['tipo']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerFilme(".$row['id'].")'>Remover</button></td>";
                //$msg .= "<td><button type='button' onclick='editarFilme(".$row['id'].")'>Editar</button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "0 results";
        }
        $conn->close();

        return ($msg);
    }

    function removerFilme($id){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM filme WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return($msg);
    }

    function getInfoFilme($id){

        global $conn;
        $row = "";

        $msg = "";
        $sql = "SELECT * FROM filme WHERE id = ".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();           
        }

        $conn->close();

        return (json_encode($row));
    }

    function gravarEdicaoFilme($nome, $ano, $descricao, $tipo_filme_id, $id){
        global $conn;
        $msg = "";

        $sql = "UPDATE filme SET nome = '".$nome."', ano = '".$ano."', descricao = '".$descricao."', tipo_filme_id = '".$tipo_filme_id."' WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
          $msg = "Filme editado com sucesso";
        } else {
          $msg = "Error updating record: " . $conn->error;
        }
        
        $conn->close();

        return ($msg);
    }


    function getFilme(){
        global $conn;
        $msg = "<option value = '-1'>Escolha um filme</option>";

        $sql = "SELECT * FROM filme";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['nome']."</option>";
        }
        } else {
            $msg .= "<option value = '-1'>Sem filmes registados</option>";
        }
        $conn->close();
        
        return $msg;
    }

    function getTipoFilme(){
        global $conn;
        $msg = "<option value = '-1'>Escolha um tipo de filme</option>";

        $sql = "SELECT tipo_filme.* FROM tipo_filme";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
        }
        } else {
            $msg .= "<option value = '-1'>Sem tipos registados</option>";
        }
        $conn->close();
        
        return $msg;
    }

    function contagemFilmes(){
        global $conn;        
        $sql = "SELECT COUNT(*) as total_filmes FROM filme";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Obtém a linha com o resultado
            $row = $result->fetch_assoc();
            echo $row['total_filmes'];
        } else {
            echo "0";
        }
        $conn->close();
    }


    // testeeeee
    function listarSessoesAtivas(){

        global $conn;

        $msg = "";
        $sql = "SELECT sessao.*, sala.descricao AS salaSessao, filme.nome AS filmeSessao, estado.descricao AS estadoSessao FROM sessao, sala, filme, estado WHERE sala.id = sessao.sala_id AND filme.id = sessao.filme_id AND estado.id = sessao.estado_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<td>".$row['filmeSessao']."</td>";
                $msg .= "<td>".$row['salaSessao']."</td>";
                $msg .= "<td>".$row['data_sessao']."</td>";
                $msg .= "<td>".$row['hora']."</td>";
                $msg .= "<td>".$row['estadoSessao']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerSessao(".$row['id'].")'>Remover</button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "0 results";
        }
        $conn->close();

        return ($msg);
    }


}
    

?>