<?php

require_once 'connection.php';

class Sessao{

    function registarSessao($filme_id, $sala_id, $data_sessao, $hora, $estado_id ){

        global $conn;
        $msg = "";

        $sql = "INSERT INTO sessao (filme_id, sala_id, data_sessao, hora, estado_id) VALUES ('".$filme_id."', '".$sala_id."', '".$data_sessao."','".$hora."','".$estado_id."')";
        
        if ($conn->query($sql) === TRUE) {
          $msg = "Sessão registada com sucesso!";
        } else {
          $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();

        return ($msg);
    }

    function listarSessoes(){

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

    function removerSessao($id){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM sessao WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return($msg);
    }

    function getInfoSessao($id) {
        global $conn;
    
        $sql = "SELECT * FROM sessao WHERE id = ".$id;
        $result = $conn->query($sql);
        $row = null;  // Inicializa $row como nulo
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
    
        $conn->close();
    
        return json_encode($row);
    }

    function gravarEdicaoSessao($filme_id, $sala_id, $data_sessao, $hora, $estado_id, $id) {
        global $conn;
    
        $sql = "UPDATE sessao SET filme_id = '".$filme_id."', sala_id = '".$sala_id."', data_sessao = '".$data_sessao."', hora = '".$hora."', estado_id = '".$estado_id."' WHERE id = ".$id;
    
        if ($conn->query($sql) === TRUE) {
            $msg = "Sessão editada com sucesso";
        } else {
            $msg = "Error updating record: " . $conn->error;
        }
    
        $conn->close();
    
        return $msg;
    }


    function getFilmeParaSessao(){
        global $conn;
        $msg = "<option value = '-1'>Escolha um Filme</option>";

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

    function getSalaParaSessao(){
        global $conn;
        $msg = "<option value = '-1'>Escolha uma Sala</option>";

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

    function getEstado(){
        global $conn;
        $msg = "<option value = '-1'>Selecione o estado da sessão</option>";

        $sql = "SELECT * FROM estado";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
        }
        } else {
            $msg .= "<option value = '-1'>Sem estados registados</option>";
        }
        $conn->close();
        
        return $msg;
    }

    function getSessao(){
        global $conn;
        $msg = "<option value = '-1'>Escolha uma sessão</option>";

        $sql = "SELECT sessao.id, sessao.data_sessao, filme.nome AS filme_nome FROM sessao JOIN filme ON sessao.filme_id = filme.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['data_sessao']." - ".$row['filme_nome']."</option>";
        }
        } else {
            $msg .= "<option value = '-1'>Sem sessões registadas</option>";
        }
        $conn->close();
        
        return $msg;
    }

}
    

?>