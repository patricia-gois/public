<?php

require_once 'connection.php';

class Emprestimo {

    function registaEmprestimo($id_livro, $data_registo, $data_entrega, $id_utilizador, $id_socio) {
        global $conn;
        $msg = "";

        // Passo 1: Inserir o empréstimo na tabela emprestimo
        $stmt = $conn->prepare("INSERT INTO emprestimo (data_registo, data_entrega, id_utilizador, id_socio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $data_registo, $data_entrega, $id_utilizador, $id_socio);
        
        if ($stmt->execute()) {
            // Obter o ID do empréstimo recém-criado
            $id_emprestimo = $conn->insert_id;

            // Passo 2: Inserir a relação na tabela livro_emprestimo
            $stmt2 = $conn->prepare("INSERT INTO livro_emprestimo (id_emprestimo, id_livro) VALUES (?, ?)");
            $stmt2->bind_param("ii", $id_emprestimo, $id_livro);

            if ($stmt2->execute()) {
                $msg = "Registro efetuado com sucesso.";
            } else {
                // Caso a inserção na tabela `livro_emprestimo` falhe
                $msg = "Erro ao registrar livro no empréstimo: " . $stmt2->error;
            }

            $stmt2->close();
        } else {
            // Caso a inserção na tabela `emprestimo` falhe
            $msg = "Erro ao registrar empréstimo: " . $stmt->error;
        }

        // Fechar a declaração preparada
        $stmt->close();
        return $msg;
    }

    function getLivro(){
        global $conn;
        $msg = "<option selected'>Selecione um livro</option>";
        $sql = "SELECT * FROM livros";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['id']."'>". $row['titulo']."</option>";
            }
        } else {
            $msg = "<option value='-1'>Sem livros registados</option>";
        }
        return $msg;
    }

    function listaEmprestimos(){

        global $conn;

        $msg = "";
        $sql = "SELECT 
                    emprestimo.id,
                    livros.titulo AS livro_titulo,
                    emprestimo.data_registo,
                    emprestimo.data_entrega,
                    utilizador.nome AS utilizador_nome,
                    socio.nome AS socio_nome
                FROM 
                    emprestimo,
                    livro_emprestimo,
                    livros,
                    utilizador,
                    socio
                WHERE 
                    emprestimo.id = livro_emprestimo.id_emprestimo
                    AND emprestimo.id_utilizador = utilizador.id
                    AND emprestimo.id_socio = socio.id
                    AND livro_emprestimo.id_livro = livros.id;
                ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['id']."</td>";
                $msg .= "<td>".$row['data_registo']."</td>";
                $msg .= "<td>".$row['data_entrega']."</td>";
                $msg .= "<td>".$row['livro_titulo']."</td>";
                $msg .= "<td>".$row['utilizador_nome']."</td>";
                $msg .= "<td>".$row['socio_nome']."</td>";
                $msg .= "<td><button class='btn btn-danger' onclick='removerEmprestimo(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";
                //$msg .= "<td><button class='btn btn-warning' onclick='getInfoLivro(".$row['id'].")'><i class='fa fa-pencil'></i></button></td>";
                $msg .= "</tr>";
            }
        } else {
        $msg = "Sem resultados";
        }
        $conn->close();

        return ($msg);
    }

    function removerEmprestimo($id){

        global $conn;
        $msg = "";
        $sql = "DELETE FROM emprestimo WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return($msg);
    }

    function getEmprestimo(){
        global $conn;
        $msg = "<option selected'>Selecione um empréstimo</option>";
        $sql = "SELECT 
                    emprestimo.*,
                    socio.nome AS nome_socio
                FROM 
                    emprestimo
                JOIN 
                    socio 
                ON 
                    emprestimo.id_socio = socio.id;";

        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['id']."'>". $row['data_registo']." - ".$row['nome_socio']."</option>";
            }
        } else {
            $msg = "<option value='-1'>Sem empréstimos registados</option>";
        }
        return $msg;
    }

    function getInfoEmprestimo($id){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT emprestimo.* FROM emprestimo WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));
    }


}

?>