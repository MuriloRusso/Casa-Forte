<?php 

 include('../connect.php');


if(isset($_POST['username']) || isset($_POST['password'])){

    if(strlen($_POST['username']) == 0){

        echo "<p class='btn-delete btn'>Nome de usuário em Branco</p>";

    }

    else if(strlen($_POST['password']) == 0){

        echo "<p class='btn-delete btn'>Preencha o campo Senha</p>";

    }

    else{

        $user = $mysqli->real_escape_string($_POST['username']);
        $senha = $mysqli->real_escape_string($_POST['password']);

        $sql_code = "SELECT * FROM usuario WHERE email = '$user' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)){

                session_start();


            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['papel'] = $usuario['papel'];
            $_SESSION['data_nascimento'] = $usuario['data_nascimento'];
            $_SESSION['telefone'] = $usuario['telefone'];
            $_SESSION['rua'] = $usuario['rua'];
            $_SESSION['telefone'] = $usuario['telefone'];
            $_SESSION['cep'] = $usuario['cep'];
            $_SESSION['numero'] = $usuario['numero'];
            $_SESSION['cidade'] = $usuario['cidade'];
            $_SESSION['estado'] = $usuario['estado'];
            $_SESSION['complemento'] = $usuario['complemento'];
            $_SESSION['avatar'] = $usuario['avatar'];

            header("Location: index.php");

            // print '<script>    window.location.href = "index.php";
            // </script>';

        }

        else{

            echo "<p class='btn-delete btn'>Falha ao Logar, email ou senha incorretos!</p>";

        }

    }

}

?>