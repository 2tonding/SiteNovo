<?php
session_start();
include_once "databaseconnect.php";

$login = $_POST['login'];
$senha = MD5($_POST['senha']);
$sql = "SELECT login FROM users WHERE login = '$login'";
$result = $conn->query( $sql );
$array = $result->fetch();
$logarray = $array['login'];
print_r($logarray);

if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>
        alert('O campo login deve ser preenchido');window.location.href='cadastro.html';
        </script>";
  }else{
      if($logarray == $login){
        echo"<script language='javascript' type='text/javascript'>
            alert('Esse login já existe');window.location.href='cadastro.html';
            </script>";
        die();
      }else{
          // eu deveria ter feito uma funcao chamada insert() e colocado em um arquivo separado?
        $sql = "INSERT INTO users (login,senha) VALUES ('$login','$senha')";
        $insert = $conn->query( $sql );

        if($insert){
          $_SESSION['login'] = $login;
          echo"<script language='javascript' type='text/javascript'>
          			window.location.href='cadastro-completo.php'
		  		</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');window.location
          .href='cadastro.html'</script>";
        }

      }
  }
?>
