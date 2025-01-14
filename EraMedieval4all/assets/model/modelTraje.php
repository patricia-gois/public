<?php

require_once 'connection.php';

class Traje {

    function registTraje($ref, $nome, $estado, $valor, $imagem, $id_tipo, $id_armazem) {
        global $conn;
        $msg = "";
        $flag = true;

        $resposta = $this -> uploads($imagem);
        $resposta = json_decode($resposta, TRUE);

        if($resposta['flag']){
            $sql = "INSERT INTO guarda_roupa (ref, nome, estado, valor, imagem, id_tipo, id_armazem) VALUES ('".$ref."', '".$nome."','".$estado."','".$valor."','".$resposta['target']."','".$id_tipo."','".$id_armazem."')";
        }else{
            $sql = "INSERT INTO guarda_roupa (ref, nome, estado, valor, id_tipo, id_armazem) VALUES ('".$ref."', '".$nome."','".$estado."','".$valor."','".$id_tipo."','".$id_armazem."')";
        }

        if ($conn->query($sql) === TRUE) {
            $msg = "Registado com sucesso!";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            $resUpdate = $this -> updateFoto($resposta['target'], $desc);        
            $resUpdate = json_decode($resUpdate, TRUE);
        }

        $conn->close();
      
        // Return response as JSON
        return json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
    }

    function updateImagem($diretorio, $id){
        global $conn;
        $msg = "";
        $flag = true;
 
        $sql = "UPDATE guarda_roupa SET imagem = '".$diretorio."' WHERE ref = ".$id;
 
        if ($conn->query($sql) === TRUE) {
            $msg = "Registado com Sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
 
        $resposta = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
 
        return($resposta);
    }

    function removeTraje($ref){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM guarda_roupa WHERE ref = ".$ref;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return $msg;
    }

    function listTrajes(){

        global $conn;

        $msg = "";
        $sql = "SELECT * FROM guarda_roupa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['ref']."</td>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['estado']."</td>";
                $msg .= "<td>".$row['valor']."</td>";
                $msg .= "<td><img class='imagem-traje' src='".$row['imagem']."'></td>";
                $msg .= "<td>".$row['id_tipo']."</td>";
                $msg .= "<td>".$row['id_armazem']."</td>";
                $msg .= "<td><button class='btn btn-danger' onclick='removeTraje(".$row['ref'].")'><i class='fa fa-trash'></i></button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "Sem resultados";
        }

        $conn->close();
        return ($msg);
    }

    function getInfoTraje($ref){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM guarda_roupa WHERE ref =".$ref;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }
    
    function uploads($imagem){

        $dir = "../imagens/";
        $dir1 = "src/imagens/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro, não é possivel criar o diretório");
            }
        }
        if(isset($_FILES['imagem']) && is_uploaded_file($_FILES['imagem']['tmp_name'])) {
            $fonte = $_FILES['imagem']['tmp_name'];
            $ficheiro = $_FILES['imagem']['name'];
            $extensao = pathinfo($ficheiro, PATHINFO_EXTENSION);
        
            $newName = "traje" . date("YmdHis") . "." . $extensao;
            $target = $dir . $newName;
            $targetBD = $dir1 . $newName;
        
            if(move_uploaded_file($fonte, $target)) {
                return json_encode(array(
                    "flag" => true,
                    "target" => $targetBD
                ));
            } else {
                return json_encode(array(
                    "flag" => false,
                    "msg" => "Erro ao mover o arquivo."
                ));
            }
        } else {
            return json_encode(array(
                "flag" => false,
                "msg" => "Nenhuma imagem foi enviada."
            ));
        }
    }

    function wFicheiro($texto){
        $file = '../logs.txt';
        // Open the file to get existing content
        $current = file_get_contents($file);
        $current .= $texto."\n";
        // Write the contents back to the file
        file_put_contents($file, $current);
    }

    function guardaEditTraje($ref, $nome, $estado, $valor, $imagem, $id_tipo, $id_armazem) {
        global $conn;
        $msg = "";
        $flag = true;
    
        // Prepare the statement to update the book details
        $stmt = $conn->prepare("UPDATE guarda_roupa SET ref = ?, nome = ?, estado = ?, valor = ?, imagem = ?, id_tipo = ?, id_armazem = ? WHERE ref = ?");
        $stmt->bind_param("sssdsii", $ref, $nome, $estado, $valor, $imagem, $id_tipo, $id_armazem);
    
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

    function getTiposTraje() {
        global $conn;
        $msg = "<option value=''>Selecione um tipo</option>";
        
        $sql = "SELECT id, descricao FROM tipo_groupa";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='". $row['id']."'>".$row['descricao']."</option>";
            }
        } else {
            $msg = "<option value=''>Sem tipos registados</option>";
        }
        
        $conn->close();
        return $msg;
    }

    function getArmazens() {
        global $conn;
        $msg = "<option value=''>Selecione um armazém</option>";
        
        $sql = "SELECT id, nome FROM armazem";
        $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $msg .= "<option value='".$row['id']. "'>".$row['nome']."</option>";
                }
            } else {
                $msg = "<option value=''>Sem armazéns registados</option>";
            }

            $conn->close();
            return $msg;
    }

    function getTrajes() {
        global $conn;
        $msg = "<option value=''>Selecione um traje</option>";
    
        $sql = "SELECT ref, nome FROM guarda_roupa";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='" . $row['ref'] . "'>" . $row['nome'] . "</option>";
            }
        } else {
            $msg = "<option value=''>Sem trajes disponíveis</option>";
        }
    
        $conn->close();
        return $msg;
    }


}

?>