<?php
    class FormUsu{
        public static function alert($tipo, $mensagem){
            if($tipo == 'erro'){
                echo '<div style="color:red; font-size25px; background:black">'.$mensagem.'</div>';
                return false;
            }
            else if($tipo == 'sucesso'){
                echo '<div style="color:green; font-size25px; background:black">'.$mensagem.'</div>';
                return true;
            }
        }

        public static function cadastrar($apelido, $cpf, $pronomes, $email, $senha){
            $sql = Mysql::conectar()->prepare("INSERT INTO `usuario`(Apelido_Usuario, CPF_Usuario, Pronomes, Email_Usuario, Senha_Usuario) VALUES(?,?,?,?,?)");
            $sql->execute(array($apelido, $cpf, $pronomes, $email, $senha));
        }
    }
?>