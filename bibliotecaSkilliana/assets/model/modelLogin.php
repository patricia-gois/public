<?php

require_once 'connection.php';

class Login{
    
        // Defina a chave e o IV para criptografia AES (exemplo)
        private $encryption_key = 'chave_de_criptografia_de_256_bits'; // Coloque aqui uma chave de 32 caracteres
        private $iv = 'chave_16bytes_iv'; // IV de 16 bytes para AES-256-CBC
    
        private function encryptAES($data) {
            return openssl_encrypt($data, 'AES-256-CBC', $this->encryption_key, 0, $this->iv);
        }
    
        private function decryptAES($encrypted_data) {
            return openssl_decrypt($encrypted_data, 'AES-256-CBC', $this->encryption_key, 0, $this->iv);
        }
    
        function registaUser($username, $pw, $pergunta, $resposta, $id_tipo){
        
            global $conn;
            $msg = "";
            $flag = false;
    
            $foto = "assets/img/user/user.webp";
    
            // Criptografa a senha usando AES
            $encrypted_pw = $this->encryptAES($pw);
    
            $stmt = $conn->prepare("INSERT INTO user (username, pw, pergunta, resposta, id_tipo, foto) VALUES (?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("ssisis", $username, $encrypted_pw, $pergunta, $resposta, $id_tipo, $foto);
    
            if ($stmt->execute()) {
                $msg = "Registado com sucesso!";
                $flag = true;
            } else {
                $msg = "Erro ao registrar o usuário: " . $stmt->error;
            }
            
            $resp = json_encode(array(
                "flag" => $flag,
                "msg" => $msg
            ));
    
            $stmt->close();
            $conn->close();
    
            return $resp;
        }
    

        function login($username, $pw) {
            global $conn;
            $msg = "";
            $flag = true;
            session_start();
        
            // Captura o IP de origem
            $ip_origem = $_SERVER['REMOTE_ADDR'];
        
            // Primeiro, verifica se o usuário existe e se está bloqueado
            $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        
                // Verifica se o usuário está bloqueado
                if ($row['conta_bloqueada'] == 1) {
                    $flag = false;
                    $msg = "Conta bloqueada devido a múltiplas tentativas de login falhas.";
                    $estado = 'conta_bloqueada';
                } else {
                    // Descriptografa a senha armazenada
                    $stored_password = $this->decryptAES($row['pw']);
        
                    // Compara a senha descriptografada com a senha fornecida
                    if ($stored_password === $pw) {
                        // Login bem-sucedido, reseta tentativas de login e desbloqueia a conta
                        $stmt_reset = $conn->prepare("UPDATE user SET tentativas_login = 0, conta_bloqueada = 0 WHERE username = ?");
                        $stmt_reset->bind_param("s", $username);
                        $stmt_reset->execute();
                        $stmt_reset->close();
        
                        // Verifica se o usuário tem o tipo correto (id_tipo == 3)
                        if ($row['id_tipo'] == 3) {
                            $msg = "Bem-vindo(a), " . $row['username'] . "!";
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['id_tipo'] = $row['id_tipo'];
                            $_SESSION['foto'] = $row['foto'];
                            $estado = 'sucesso';
                        } else {
                            $flag = false;
                            $msg = "Acesso negado. Este tipo de utilizador não tem permissão.";
                            $estado = 'falha';
                        }
                    } else {
                        // Senha incorreta, incrementa as tentativas de login
                        $stmt_increment = $conn->prepare("UPDATE user SET tentativas_login = tentativas_login + 1 WHERE username = ?");
                        $stmt_increment->bind_param("s", $username);
                        $stmt_increment->execute();
                        $stmt_increment->close();
        
                        // Atualiza o número de tentativas e verifica se deve bloquear a conta
                        if ($row['tentativas_login'] + 1 >= 3) {
                            $stmt_block = $conn->prepare("UPDATE user SET conta_bloqueada = 1 WHERE username = ?");
                            $stmt_block->bind_param("s", $username);
                            $stmt_block->execute();
                            $stmt_block->close();
        
                            $msg = "Conta bloqueada devido a múltiplas tentativas de login falhadas.";
                            $estado = 'conta_bloqueada';
                        } else {
                            $msg = "Erro! Dados inválidos. Tentativas restantes: " . (3 - ($row['tentativas_login'] + 1));
                            $estado = 'falha';
                        }
                        $flag = false;
                    }
                }
            } else {
                // Usuário não encontrado
                $flag = false;
                $msg = "Erro! Dados inválidos";
                $estado = 'falha';
            }
        
            // Registro da tentativa de login
            $stmt_log = $conn->prepare("INSERT INTO login_attempts (username, hora, ip_origem, estado) VALUES (?, NOW(), ?, ?)");
            $stmt_log->bind_param("sss", $username, $ip_origem, $estado);
            $stmt_log->execute();
            $stmt_log->close();
        
            $stmt->close();
            $conn->close();
        
            return json_encode(array(
                "msg" => $msg,
                "flag" => $flag
            ));
        }
        
    function logout(){

        session_start();
        session_destroy();

        return("Obrigado!");
    }

    function getTipos(){

        global $conn;
        $msg = "<option value = '-1'>Escolha uma opção</option>";


        $stmt = $conn->prepare("SELECT * FROM tipo_utilizador");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
            }
        }else{
            $msg .= "<option value = '-1'>Sem tipos registados</option>";
        }

        $stmt->close();
        $conn->close();
        return $msg;
    }

}


?>