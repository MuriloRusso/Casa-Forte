<?php 

	include('../connect.php');

	$password = $mysqli->real_escape_string($_POST['password']);

	$passwordConfirm = $mysqli->real_escape_string($_POST['passwordConfirm']);

	$newPassword = $mysqli->real_escape_string($_POST['newPassword']);

    $id = $mysqli->real_escape_string($_POST['id']);

    $sql_code = "SELECT * FROM usuario WHERE id=".$id;

    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

    $user = $sql_query->fetch_object();

    if($password == $passwordConfirm){//confirmação não confere

        if($user->senha == $password){//senha atual incorreta          

            $sql_code = "UPDATE usuario SET senha='{$newPassword}' WHERE id=".$id;

            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

            print 'Senha Alterada com sucesso';


        }

        else{

            print 'Senha Incorreta';

        }


    }

    else{

        print 'Confirmação da Senha incorreta';

    }


	// header("Location: ../my-profile.php");


?>