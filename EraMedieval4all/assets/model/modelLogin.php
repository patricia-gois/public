<?php

require_once 'connection.php';


class Login{
    
        // defines key and iv to encryptation
        private $encryption_key = 'chave_de_criptografia_de_256_bits'; // 32 characters key
        private $iv = 'chave_16bytes_iv'; // IV 16 bytes for AES-256-CBC
    
        private function encryptAES($data) {
            return openssl_encrypt($data, 'AES-256-CBC', $this->encryption_key, 0, $this->iv);
        }
    
        

        private function decryptAES($encrypted_data) {
            return openssl_decrypt($encrypted_data, 'AES-256-CBC', $this->encryption_key, 0, $this->iv);
        }
    
        function registUser($nome, $morada, $telefone, $email, $password, $id_tipo){
        
            global $conn;
            $msg = "";
            $flag = false;
    
            $foto = "assets/img/user/user.webp";
            $status_login = "ativo";
    
            // cryptograph password with AES
            $encrypted_pw = $this->encryptAES($password);
    
            $stmt = $conn->prepare("INSERT INTO utilizador (nome, morada, telefone, email, password, id_tipo, foto, status_login) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("sssssiss", $nome, $morada, $telefone, $email, $encrypted_pw, $id_tipo, $foto, $status_login);
    
            if ($stmt->execute()) {
                $msg = "Registado com sucesso!";
                $flag = true;
            } else {
                $msg = "Erro ao registrar o utilizador: " . $stmt->error;
            }
            
            $resp = json_encode(array(
                "flag" => $flag,
                "msg" => $msg
            ));
    
            $stmt->close();
            $conn->close();
    
            return $resp;
        }
    

        function login($nome, $password) {
            global $conn;
            session_start();
        
            $msg = "";
            $flag = false;
        
            // search user
            $stmt = $conn->prepare("SELECT id, nome, password, conta_bloqueada, tentativas_login, status_login FROM utilizador WHERE nome = ?");
            $stmt->bind_param("s", $nome);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        
                // if blocked, block message without incrementation of tentativas
                if ($row['conta_bloqueada'] === 'blocked') {
                    $msg = "Conta bloqueada devido a múltiplas tentativas de login falhadas.";
                } else {
                    // decrypt and compare password
                    $stored_password = $this->decryptAES($row['password']);
                    if ($stored_password === $password) {
                        // well done login
                        $stmt_reset = $conn->prepare("UPDATE utilizador SET tentativas_login = 0, conta_bloqueada = 'ok' WHERE nome = ?");
                        $stmt_reset->bind_param("s", $nome);
                        $stmt_reset->execute();
                        $stmt_reset->close();
        
                        // verifies status_login
                        if ($row['status_login'] === 'ativo') {
                            $_SESSION['nome'] = $row['nome'];
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['status_login'] = $row['status_login'];
                            $msg = "Bem-vindo(a), " . $row['nome'] . "!";
                            $flag = true;
                        } else {
                            $msg = "Acesso negado. Este utilizador está inativo.";
                        }
                    } else {
                        // wrong password increments tentativas
                        $tentativas = $row['tentativas_login'] + 1;
                        $stmt_increment = $conn->prepare("UPDATE utilizador SET tentativas_login = ? WHERE nome = ?");
                        $stmt_increment->bind_param("is", $tentativas, $nome);
                        $stmt_increment->execute();
                        $stmt_increment->close();
        
                        // blocks user login
                        if ($tentativas >= 3) {
                            $stmt_block = $conn->prepare("UPDATE utilizador SET conta_bloqueada = 'blocked' WHERE nome = ?");
                            $stmt_block->bind_param("s", $nome);
                            $stmt_block->execute();
                            $stmt_block->close();
                            $msg = "Conta bloqueada devido a múltiplas tentativas de login falhadas.";
                        } else {
                            $msg = "Erro! Dados inválidos. Tentativas restantes: " . (3 - $tentativas);
                        }
                    }
                }
            } else {
                // Usuário não encontrado
                $msg = "Erro! Dados inválidos";
            }
        
            // Retorna a mensagem e o flag em JSON para o JavaScript processar
            return json_encode(array(
                "msg" => $msg,
                "flag" => $flag
            ));
        }
        
        
        
        

        function logout() {
            global $conn;
            session_start();
        
            // Obtém o ID do usuário da sessão
            $user_id = $_SESSION['id'];
        
            // Registra o horário do logout
            $stmt_logout = $conn->prepare("UPDATE login SET horaLogout = NOW() WHERE id_utilizador = ? AND horaLogout IS NULL");
            $stmt_logout->bind_param("i", $user_id);
            $stmt_logout->execute();
            $stmt_logout->close();
        
            // Finaliza a sessão do usuário
            session_destroy();
        
            return json_encode(array("msg" => "Obrigado!", "flag" => true));
        }
        

        function getTypes() {
            global $conn;
            $msg = "<option value='-1'>Escolha uma opção</option>";
        
            // Prepara a consulta para selecionar todos os tipos de usuário
            $stmt = $conn->prepare("SELECT id, descricao FROM tipo_user");
            if ($stmt->execute()) {
                $result = $stmt->get_result();
        
                // Verifica se há registros
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $msg .= "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['descricao']) . "</option>";
                    }
                } else {
                    $msg .= "<option value='-1'>Sem tipos registados</option>";
                }
        
                // Fecha o resultado e a declaração
                $result->free();
                $stmt->close();
            } else {
                // Em caso de erro na execução da consulta
                $msg .= "<option value='-1'>Erro ao buscar tipos de usuários</option>";
            }
        
            return $msg;
        }

        function listaLogins(){

            global $conn;
    
            $msg = "";
            $sql = "SELECT 
                        login.id, 
                        login.horaLogin, 
                        login.horaLogout, 
                        login.id_utilizador, 
                        utilizador.nome AS nome_utilizador
                    FROM 
                        login
                    JOIN 
                        utilizador ON login.id_utilizador = utilizador.id;
                    ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";
                    $msg .= "<td>".$row['id']."</td>";
                    $msg .= "<td>".$row['nome_utilizador']."</td>";
                    $msg .= "<td>".$row['horaLogin']."</td>";
                    $msg .= "<td>".$row['horaLogout']."</td>";
                    $msg .= "</tr>";
                }
            } else {
            $msg = "Sem resultados";
            }
            $conn->close();
    
            return ($msg);
        }

}


?>